<?php

namespace MediaWiki\Extension\MetaStore;

use OutputPage, Parser, PPFrame, Skin;

/**
 * Class MW_EXT_Key
 */
class MW_EXT_Key {

	/**
	 * Register tag function.
	 *
	 * @param Parser $parser
	 *
	 * @return bool
	 * @throws \MWException
	 */
	public static function onParserFirstCallInit( Parser $parser ) {
		$parser->setFunctionHook( 'key', [ __CLASS__, 'onRenderTag' ], Parser::SFH_OBJECT_ARGS );

		return true;
	}

	/**
	 * Render tag function.
	 *
	 * @param Parser $parser
	 * @param PPFrame $frame
	 * @param array $args
	 *
	 * @return string
	 */
	public static function onRenderTag( Parser $parser, PPFrame $frame, array $args ) {
		$outHTML = '';
		$lastArg = end( $args );

		foreach ( $args as $arg ) {
			$key = MW_EXT_Kernel::outClear( $frame->expand( $arg ) );

			if ( $arg === $lastArg ) {
				$plus = '';
			} else {
				$plus = '<span class="mw-ext-key-plus">+</span>';
			}

			$outHTML .= '<kbd class="mw-ext-key navigation-not-searchable">' . $key . '</kbd>' . $plus;
		}

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
	 */
	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		$out->addModuleStyles( [ 'ext.mw.key.styles' ] );

		return true;
	}
}
