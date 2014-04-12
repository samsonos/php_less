<?php
namespace samson\less;

use samson\core\ExternalModule;
use samson\resourcerouter;

/**
 * Интерфейс для подключения модуля в ядро фреймворка SamsonPHP
 *
 * @package SamsonPHP
 * @author Vitaly Iegorov <vitalyiegorov@gmail.com>
 * @author Nikita Kotenko <nick.w2r@gmail.com>
 * @version 0.1
 */
class SamsonLessConnector extends ExternalModule
{
	/** Идентификатор модуля */
	protected $id = 'less'; 	
	
	/** Список модулей от которых завист данный модуль */
	protected $requirements = array
	(
		'resourcer'	
	);
	
	/**	@see ModuleConnector::init() */
	public function init( array $params = array() )
	{	
		// Pointer to resourcerouter			
		$rr = m('resourcer');
		
		// If CSS resource has been updated
		if( isset($rr->updated['css']))	try
		{	
			$less = new \lessc;
			
			// Read updated CSS resource file and compile it
			$css = $less->compile( file_get_contents( $rr->updated['css'] ) );
			
			// Write to the same place
			file_put_contents( $rr->updated['css'], $css );
		}
		catch( Exception $e){ e('Ошибка обработки CSS: '.$e->getMessage()); }
		
		// Вызовем родительский метод
		parent::init( $params );				
	}	
}