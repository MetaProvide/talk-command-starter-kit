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

use Exception;
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
				'day',
				InputArgument::REQUIRED,
				'Day of birth'
			)
			->addArgument(
				'month',
				InputArgument::REQUIRED,
				'Month of birth'
			)
			->addArgument(
				'value',
				InputArgument::OPTIONAL,
				'The value of the example',
				'the default value'
			)
		;
	}
	protected function  getsign($day,$month) {
		if(($month==1 && $day>20)||($month==2 && $day<19)) {
			$mysign = "aquarius";
		}
		if(($month==2 && $day>18 )||($month==3 && $day<21)) {
			$mysign = "pisces";
		}
		if(($month==3 && $day>20)||($month==4 && $day<20)) {
			$mysign = "aries";
		}
		if(($month==4 && $day>20)||($month==5 && $day<20)) {
			$mysign = "taurus";
		}
		if(($month==5 && $day>21)||($month==6 && $day<22)) {
			$mysign = "gemini";
		}
		if(($month==6 && $day>21)||($month==7 && $day<24)) {
			$mysign = "cancer";
		}
		if(($month==7 && $day>23)||($month==8 && $day<24)) {
			$mysign = "leo";
		}
		if(($month==8 && $day>23)||($month==9 && $day<24)) {
			$mysign = "virgo";
		}
		if(($month==9 && $day>23)||($month==10 && $day<24)) {
			$mysign = "libra";
		}
		if(($month==10 && $day>23)||($month==11 && $day<23)) {
			$mysign = "scorpio";
		}
		if(($month==11 && $day>22)||($month==12 && $day<23)) {
			$mysign = "sagittarius";
		}
		if(($month==12 && $day>22)||($month==1 && $day<21)) {
			$mysign = "capricorn";
		}
		return $mysign;
	}
	protected function execute(InputInterface $input, OutputInterface $output): int {
		$day = $input->getArgument("day");
		$month = $input->getArgument("month");

		$timestamp = strtotime($month);

		if(is_int($timestamp))
			$monthNumber = date("m", $timestamp);
		else{
			$output->writeln("Invalid Month");
		}

		if($day == 0 || $day >31){
			$output->writeln("Invalid day");
		}else{
			$sign = $this->getsign($day,$monthNumber);

			$output->writeln($sign);
		}
		return 0;
	}
}
