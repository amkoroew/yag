<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktsuteam.de>
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
 * Class provides image viewHelper
 * 
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package ViewHelpers
 */
class Tx_Yag_ViewHelpers_FilterBoxViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractTagBasedViewHelper {


	/**
	 * @var Tx_PtExtlist_Domain_Model_Filter_FilterboxCollection
	 */
	protected $filterBoxCollection;



	public function initialize() {
		$this->filterBoxCollection = Tx_Yag_Domain_Context_YagContextFactory::getInstance()
				  ->getItemlistContext()
				  ->getFilterBoxCollection();
	}


	/**
	 * Initialize arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerTagAttribute('identifier', 'string', 'The FilterIdentifier to use', true);
	}



	/**
	 * @return void
	 */
	public function render() {
		$content = '';

		$filterBoxIdentifier = $this->arguments['identifier'];
		
		if($filterBoxIdentifier && $this->filterBoxCollection->hasItem($filterBoxIdentifier)) {
			$this->templateVariableContainer->add('filterbox', $this->filterBoxCollection->getFilterboxByFilterboxIdentifier($filterBoxIdentifier));
			$content = $this->renderChildren();
			$this->templateVariableContainer->remove('filterbox');
		} else {
			$content = 'No Filter with filterBoxIdentifier ' . $filterBoxIdentifier . ' was found!';
		}

		return $content;
	}
}