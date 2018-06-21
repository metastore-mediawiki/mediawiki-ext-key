<?php

namespace MediaWiki\Extension\MW_EXT_Key;

use OutputPage, Parser, PPFrame, Skin;

/**
 * Class MW_EXT_Key
 * ------------------------------------------------------------------------------------------------------------------ */
class MW_EXT_Key {

	/**
	 * Clear DATA (escape html).
	 *
	 * @param $string
	 *
	 * @return string
	 * -------------------------------------------------------------------------------------------------------------- */

	private static function clearData( $string ) {
		$outString = htmlspecialchars( trim( $string ), ENT_QUOTES );

		return $outString;
	}

	/**
	 * Register tag function.
	 *
	 * @param Parser $parser
	 *
	 * @return bool
	 * @throws \MWException
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onParserFirstCallInit( Parser $parser ) {
		$parser->setHook( 'key', __CLASS__ . '::onRenderTag' );

		return true;
	}

	/**
	 * Render tag function.
	 *
	 * @param $input
	 * @param array $args
	 * @param Parser $parser
	 * @param PPFrame $frame
	 *
	 * @return string
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onRenderTag( $input, $args = [], Parser $parser, PPFrame $frame ) {
		// Get content.
		$getContent = trim( $input );
		$outContent = $getContent;

		// Out HTML.
		$outHTML = '<kbd class="mw-ext-key">' . $outContent . '</kbd>';

		// Out parser.
		$outParser = $outHTML;

		return $outParser;
	}

	/**
	 * Load resource function.
	 *
	 * @param OutputPage $out
	 * @param Skin $skin
	 *
	 * @return bool
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		$out->addModuleStyles( [ 'ext.mw.key.styles' ] );

		return true;
	}
}
