<?php
use Carbon\Carbon;
class BaseController extends Controller {


	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => ['post', 'delete', 'put']));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	private function convertToLocalTimeZones($value) 
	{

		$utc = Carbon::createFromFormat($this->getDateFormat(), $value);
	    return $utc->setTimezone('America/Chicago');	
	}

}
