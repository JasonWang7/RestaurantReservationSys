<?php
/**
 * routing rule interface. implemented using strategy pattern
 * user implement the routing rule 
 * @author Jinhai Wang
 * Date: Feb 25, 2015
 */
interface IRoute{

	public function dispatchRule();
	public function dispatchAction();
}
?>