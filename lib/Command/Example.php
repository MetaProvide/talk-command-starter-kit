<?php

declare(strict_types=1);

/**
 * Talk Command Starter Kit
 *
 * @copyright Copyright (C) 2022  NAME <email>
 *
 * @author NAME <email>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\TalkCommandStarterKit\Command;

use OCP\IConfig;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;

class Example extends Command {
	/** @var IConfig */
	private $config;

	/** @var LoggerInterface */
	private $logger;


	public function __construct(IConfig $config, LoggerInterface $logger) {
		parent::__construct();
		$this->config = $config;
		$this->logger = $logger;
	}

	protected function configure(): void {
		$this
			->setName('command:example')
			->setDescription('This is an example')
			->addArgument(
				'name',
				InputArgument::REQUIRED,
				'The name of the example'
			)
			->addArgument(
				'value',
				InputArgument::OPTIONAL,
				'The value of the example',
				'the default value'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$name = $input->getArgument("name");
		$output->writeln("Hello " . $name . "!");
		return 0;
	}
}
