<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <knoll@punkt.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Utility to add the YAG Icon to Element Wizzard
 *
 * @package Utility
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Yag_Utility_SignalSlot {

	/**
	 * @var Tx_Extbase_SignalSlot_Dispatcher
	 */
	protected $signalSlotDispatcher;


	public function __construct() {
		$this->signalSlotDispatcher = t3lib_div::makeInstance('Tx_Extbase_Object_Manager')->get('Tx_Extbase_SignalSlot_Dispatcher');
	}


	/**
	 * Connects a signal with a slot.
	 * One slot can be connected with multiple signals by calling this method multiple times.
	 *
	 * @param string $signalClassName Name of the class containing the signal
	 * @param string $signalName Name of the signal
	 * @param mixed $slotClassNameOrObject Name of the class containing the slot or the instantiated class or a Closure object
	 * @param string $slotMethodName Name of the method to be used as a slot. If $slotClassNameOrObject is a Closure object, this parameter is ignored
	 * @param boolean $omitSignalInformation If set to TRUE, the first argument passed to the slot will be the first argument of the signal instead of some information about the signal.
	 * @return void
	 */
	public function connect($signalClassName, $signalName, $slotClassNameOrObject, $slotMethodName = '', $omitSignalInformation = FALSE) {
		if($this->signalSlotDispatcher) {
			$this->signalSlotDispatcher->connect($signalClassName, $signalName, $slotClassNameOrObject, $slotMethodName, $omitSignalInformation);
		}
	}


	/**
	 * Dispatches a signal by calling the registered Slot methods
	 *
	 * @param string $signalClassName Name of the class containing the signal
	 * @param string $signalName Name of the signal
	 * @param array $signalArguments arguments passed to the signal method
	 * @return void
	 */
	public function dispatch($signalClassName, $signalName, array $signalArguments = array()) {
		if($this->signalSlotDispatcher) {
			$this->signalSlotDispatcher->dispatch($signalClassName, $signalName, $signalArguments);
		}
	}



	/**
	 * Returns all slots which are connected with the given signal
	 *
	 * @param string $signalClassName Name of the class containing the signal
	 * @param string $signalName Name of the signal
	 * @return array An array of arrays with slot information
	 */
	public function getSlots($signalClassName, $signalName) {
		if($this->signalSlotDispatcher) {
			return $this->signalSlotDispatcher->getSlots($signalClassName, $signalName);
		}
	}
}
?>