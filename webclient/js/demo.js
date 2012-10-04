/*!
 * Scripts for the demo pages on the jScrollPane website.
 *
 * You do not need to include this script or use it on your site.
 *
 * Copyright (c) 2010 Kelvin Luck
 * Dual licensed under the MIT and GPL licenses.
 */
var $j = jQuery.noConflict();
$j(function()
{
	// Copy the pages javascript sourcecode to the display block on the page for easy viewing...
	var sourcecodeDisplay = $j('#sourcecode-display');
	if (sourcecodeDisplay.length) {
		sourcecodeDisplay.empty().append(
			$j('<code />').append(
				$j('<pre />').html(
					$j('#sourcecode').html().replace(/\n\t\t\t/gm, '\n').replace('>', '&gt;').replace('<', '&lt;')
				)
			)
		);
		$j('#css-display').empty().append(
			$j('<code />').append(
				$j('<pre />').html(
					$j('#page-css').html().replace(/\n\t\t\t/gm, '\n')
				)
			)
		);
	}
});

