<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Console;

use Zend\ServiceManager\ServiceManager;
use Symfony\Component\Console\Command\Command;

class CommandList
{
    /**
     * Service Manager
     *
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * Constructor
     *
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Gets list of setup command classes
     *
     * @return string[]
     */
    protected function getCommandsClasses()
    {
        return [
            'Magento\Setup\Console\Command\ConfigInstallCommand'
        ];
    }

    /**
     * Gets list of command instances
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    public function getCommands()
    {
        $commands = [];

        foreach ($this->getCommandsClasses() as $class) {
            if (class_exists($class)) {
                $command = $this->serviceManager->create($class);
                if ($command instanceof Command) {
                    $commands[] = $command;
                }
            }
        }

        return $commands;
    }
}
