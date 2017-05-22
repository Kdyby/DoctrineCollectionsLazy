<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\Doctrine\Collections\Lazy;

interface Exception
{

}

class InvalidArgumentException extends \InvalidArgumentException implements \Kdyby\Doctrine\Collections\Lazy\Exception
{

}

class NotSupportedException extends \LogicException implements \Kdyby\Doctrine\Collections\Lazy\Exception
{

}

class UnexpectedValueException extends \UnexpectedValueException implements \Kdyby\Doctrine\Collections\Lazy\Exception
{

}
