<?php

/**
 * sfDibs Module actions.
 *
 * @author     Hasse R. Hansen <hasse@reload.dk>
 */
class sfDibsActions extends sfActions
{
  
  /**
   * Executes window action
   * 
   * Generate all data fields to send to the gateway
   *
   * @param sfWebRequest $request A request object
   */
  public function executeWindow(sfWebRequest $request)
  {
    sfConfig::set('sf_web_debug', false);
    $this->setLayout(false);
    
    $this->order_id = $request->getParameter('oid', 0);
    $this->amount   = $request->getParameter('a', 0);
    
    $new_checksum  = md5($this->order_id . md5($this->amount . $_SERVER['HTTP_HOST']));
    $orig_checksum = $request->getParameter('cs', 0);
    
    if ($new_checksum !== $orig_checksum) {
      $this->redirect('@dibs_error');
    }
    
    // Generate a md5 checksum for validating at the gateway, to prevent from getting hacked
    $this->md5key = md5(  
      sfConfig::get('app_sf_dibs_key2') .
      md5(sfConfig::get('app_sf_dibs_key1') . 
      'merchant=' . sfConfig::get('app_sf_dibs_merchant_id') . 
      '&order_id=' . $this->order_id . 
      '&currency=' . sfConfig::get('app_sf_dibs_currency_code') . 
      '&amount' . $this->amount));
      
  }
  
  /**
   * Executes error action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeError(sfWebRequest $request)
  {
    
  }
  
  /**
   * Executes accept action, when completed the payment at the gateway
   *
   * @param sfWebRequest $request A request object
   */
  public function executeAccept(sfWebRequest $request) {}
  
  /**
   * Executes cancel action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCancel(sfWebRequest $request) {}
  
  /**
   * Executes callback action, which is called before the accept call
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCallback(sfWebRequest $request) {}
  
  /**
   * Executes completed action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCompleted(sfWebRequest $request) {}
}
