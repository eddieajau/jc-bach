<?php
/**
 * @package     Bach.Application
 * @subpackage  Application
 *
 * @copyright   Copyright (C) {COPYRIGHT}. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Bach CLI Application Class
 *
 * @package     Bach.Application
 * @subpackage  Application
 * @since       1.0
 */
class BachApplicationCli extends JApplicationCli
{
	/**
	 * Execute the application.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function doExecute()
	{
		// Check if help is needed.
		if ($this->input->get('h', $this->input->get('help')))
		{
			$this->_help();

			return;
		}

		// Check command line switches.
		$tzLocal = $this->input->get('l') || $this->input->get('local');
		$tzUtc = $this->input->get('u') || $this->input->get('utc');

		// Create a registry for the model state.
		$state = new JRegistry;

		// Set the timezone state for the model.
		if ($tzLocal)
		{
			$state->set('timezone', $this->config->get('timezone'));
		}
		elseif ($tzUtc)
		{
			$state->set('timezone', 'utc');
		}

		$model = new BachModelDefault($state);
		$date = $model->getTime();

		$this->out(sprintf('This time is %s', $date->toRFC822(true)));
		$this->out(sprintf('This timezone is %s', $date->getTimezone()->getName()));
	}

	/**
	 * Fetch the configuration data for the application.
	 *
	 * @return  object  An object to be loaded into the application configuration.
	 *
	 * @since   1.0
	 * @throws  RuntimeException if file cannot be read.
	 */
	protected function fetchConfigurationData()
	{
		// Initialise variables.
		$config = array();

		// Ensure that required path constants are defined.
		if (!defined('JPATH_CONFIGURATION'))
		{
			$path = getenv('BACH_CONFIG');
			if ($path)
			{
				define('JPATH_CONFIGURATION', realpath($path));
			}
			else
			{
				define('JPATH_CONFIGURATION', realpath(dirname(JPATH_BASE) . '/config'));
			}
		}

		// Set the configuration file path for the application.
		if (file_exists(JPATH_CONFIGURATION . '/config.json'))
		{
			$file = JPATH_CONFIGURATION . '/config.json';
		}
		else
		{
			// Default to the distribution configuration.
			$file = JPATH_CONFIGURATION . '/config.dist.json';
		}

		if (!is_readable($file))
		{
			throw new RuntimeException('Configuration file does not exist or is unreadable.');
		}

		// Load the configuration file into an object.
		$config = json_decode(file_get_contents($file));

		return $config;
	}

	/**
	 * Display the help text for the command line application.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	private function _help()
	{
		$this->out('Bach 1.0.');
		$this->out();
		$this->out('Tells the server, local or UTC time.');
		$this->out();
		$this->out('Usage:    run [switches]');
		$this->out();
		$this->out('  -h | --help   Prints this usage information.');
		$this->out('  -l | --local  Gives the time according to the local configuration setting.');
		$this->out('  -u | --utc    Gives the time in UTC.');
		$this->out();
		$this->out('Examples: ./run -h');
		$this->out();
	}
}
