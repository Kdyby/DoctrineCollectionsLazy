<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\Doctrine\Collections\Lazy;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Traversable;

class LazyCollection extends \Doctrine\Common\Collections\AbstractLazyCollection implements \Doctrine\Common\Collections\Selectable
{

	/**
	 * @var callable
	 */
	private $callback;

	public function __construct($callback)
	{
		if (!is_callable($callback)) {
			throw new \Kdyby\Doctrine\Collections\Lazy\InvalidArgumentException('Given value is not a callable type.');
		}
		$this->callback = $callback;
	}

	/**
	 * {@inheritdoc}
	 */
	public function matching(Criteria $criteria)
	{
		$this->initialize();
		if (!$this->collection instanceof Selectable) {
			throw new \Kdyby\Doctrine\Collections\Lazy\NotSupportedException(sprintf(
				'Collection %s does not implement Doctrine\Common\Collections\Selectable, so you cannot call ->matching() over it.',
				get_class($this->collection)
			));
		}
		return $this->collection->matching($criteria);
	}

	protected function doInitialize()
	{
		if ($this->collection === NULL) {
			$items = call_user_func($this->callback);

			if ($items instanceof Collection) {
				$items = $items->toArray();

			} elseif ($items instanceof Traversable) {
				$items = iterator_to_array($items, TRUE);
			}

			if (!is_array($items)) {
				throw new \Kdyby\Doctrine\Collections\Lazy\UnexpectedValueException(sprintf(
					'Expected array or Traversable, but %s given.',
					is_object($items) ? get_class($items) : gettype($items)
				));
			}

			$this->collection = new ArrayCollection($items);
		}

		return $this->collection;
	}

}
