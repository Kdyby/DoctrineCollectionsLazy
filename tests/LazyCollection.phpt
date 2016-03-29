<?php

/**
 * @testCase
 */

namespace KdybyTests\Doctrine\Collections\Lazy;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Kdyby\Doctrine\Collections\Lazy\LazyCollection;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class LazyCollectionTest extends Tester\TestCase
{

	public function testFromArray()
	{
		$invoked = FALSE;
		$lazy = new LazyCollection(function () use (&$invoked) {
			$invoked = TRUE;
			return [1 => 2, 3 => 4];
		});

		Assert::false($invoked);
		Assert::same([1 => 2, 3 => 4], $lazy->toArray());
		Assert::true($invoked);
	}



	public function testFromTraversable()
	{
		$invoked = FALSE;
		$lazy = new LazyCollection(function () use (&$invoked) {
			$invoked = TRUE;
			return new \ArrayIterator([1 => 2, 3 => 4]);
		});

		Assert::false($invoked);
		Assert::same([1 => 2, 3 => 4], $lazy->toArray());
		Assert::true($invoked);
	}



	public function testFromOtherCollection()
	{
		$invoked = FALSE;
		$lazy = new LazyCollection(function () use (&$invoked) {
			$invoked = TRUE;
			return new ArrayCollection([1 => 2, 3 => 4]);
		});

		Assert::false($invoked);
		Assert::same([1 => 2, 3 => 4], $lazy->toArray());
		Assert::true($invoked);
	}



	public function testMatching()
	{
		$a = (object) ['foo' => 'nope'];
		$b = (object) ['foo' => 'bar'];

		$lazy = new LazyCollection(function () use ($a, $b) {
			return [$a, $b];
		});

		$criteria = Criteria::create()
			->andWhere(Criteria::expr()->eq('foo', 'bar'));
		$matched = $lazy->matching($criteria);

		Assert::notSame($lazy, $matched);
		Assert::type('Doctrine\Common\Collections\ArrayCollection', $matched);
		Assert::same([1 => $b], $matched->toArray());
	}

}



(new LazyCollectionTest())->run();
