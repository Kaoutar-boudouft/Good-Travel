<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataAccess
 *
 * @author Admin
 */
class DataAccess {
    //1-methode connection
        public static  function connextion()
                {
                try  {
                   $bdd = new PDO('mysql:host=localhost;dbname=goodtravel;charset=utf8', 'root', '');
	    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                   return $bdd;
                   }
               catch (Exception $e)
                   {
        echo('Erreur : ' . $e->getMessage());
                   }
                }

    
    //2-Methode de mise à jour
        public static function miseajour($req)
                {
       try  {
                   $bdd= Dataaccess::connextion() ;
                   $maj=$bdd->exec($req);
                   return $maj;
                    }
               catch (Exception $e)
                   {
        echo('Erreur : ' . $e->getMessage());
                   }  $bdd=null;
                }

    //3-Methode de selection

        public static function selection($req)
                {
            try{
            $bdd=self::connextion() ;
            $rep=$bdd->query($req);
return $rep ;
                 }
               catch (Exception $e)
                   {
        echo('Erreur : ' . $e->getMessage());
                   }  $bdd=null;

       }  

    
    
}
