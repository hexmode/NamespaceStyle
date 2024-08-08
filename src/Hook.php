<?php
/**
 * Copyright (C) 2024  NicheWork, LLC
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Mark A. Hershberger <mah@nichework.com>
 */

namespace NicheWork\NamespaceStyle;

use MediaWiki\Hook\BeforePageDisplayHook;
use MediaWiki\Output\OutputPage;
use Message;
use Skin;

class Hook implements BeforePageDisplayHook {
	/**
	 * Find the page and
	 *
	 * @param OutputPage $out
	 * @param Skin $_skin
	 * @return void
	 */
	public function onBeforePageDisplay( $out, $_skin ): void {
		$title = $out->getTitle();
		$nsName = $title->getNsText();
		if ( $nsName === false || $nsName === "" ) {
			$nsName = "(main)";
		}
		$msg = new Message( "$nsName-namespace.css" );
		$cssTitle = $msg->getTitle();
		if ( !$cssTitle->exists() ) {
			return;
		}
		$url = $cssTitle->getLocalURL( [ 'action' => 'raw', 'ctype' => 'text/css' ] );
		$out->addStyle( $url );
	}
}
