<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Config;

use Symfony\Component\Config\Resource\SelfCheckingResourceInterface;

/**
 * EnvParametersResource represents resources stored in prefixed environment variables.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
class EnvParametersResource implements SelfCheckingResourceInterface, \Serializable
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $variables;

    /**
     * Constructor.
     *
     * @param string $prefix
     */
    public function __construct($prefix)
    {
        $this->prefix = $prefix;
        $this->variables = $this->findVariables();
    }

    private function findVariables()
    {
        $variables = array();

        foreach ($_SERVER as $key => $value) {
            if (0 === strpos($key, $this->prefix)) {
                $variables[$key] = $value;
            }
        }

        ksort($variables);

        return $variables;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return serialize($this->getResource());
    }

    /**
     * @return array An array with two keys: 'prefix' for the prefix used and 'variables' containing all the variables watched by this resource
     */
    public function getResource()
    {
        return array('prefix' => $this->prefix, 'variables' => $this->variables);
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($timestamp)
    {
        return $this->findVariables() === $this->variables;
    }

    public function serialize()
    {
        return serialize(array('prefix' => $this->prefix, 'variables' => $this->variables));
    }

    public function unserialize($serialized)
    {
        $unserialized = unserialize($serialized);

        $this->prefix = $unserialized['prefix'];
        $this->variables = $unserialized['variables'];
    }
}
