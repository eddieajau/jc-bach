<?php
/**
 * @package     Bach.Application
 * @subpackage  Model
 *
 * @copyright   Copyright (C) {COPYRIGHT}. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Default model for the Bach Application.
 *
 * @package     Bach.Application
 * @subpackage  Model
 * @since       1.0
 */
class BachModelDefault extends JModelBase
{
	/**
	 * Gets the time in either server, local (configuration) or universal time.
	 *
	 * @return  JDate
	 *
	 * @since   1.0
	 */
	public function getTime()
	{
		jimport('joomla.utilities.date');

		// Get the timezone from the model state.
		$timezone = $this->state->get('timezone');

		if ($timezone)
		{
			// If the timezone is set, use it.
			$time = new JDate(null, new DateTimeZone($timezone));
		}
		else
		{
			// If not, user the server timezone.
			$time = new JDate(null, new DateTimeZone(@date_default_timezone_get()));
		}

		return $time;
	}
}
