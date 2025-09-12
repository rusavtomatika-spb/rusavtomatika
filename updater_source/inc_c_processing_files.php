<?php

class c_processing_files {
  public $a_fname = [];
  public $a_fsize = [];
  public $a_fdir = [];
  public $a_hash_file = [];

  public $cofiles = 0;

  function find( $in_dir ) {

    $regexp_folders_exclude = "/^\/\/(backup|test|updater_source|admin|service|images|export|import|_.*)\/*.*/i";
    //$regexp_folders_exclude = "/^\/\/(backup|updater_source|admin|service|images|export|import|_.*)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(weintek_projects)\/*.*/i";
    $regexp_folders_include = "/^\/\/(documents|download|weintek_drivers|weintek_libraries|weintek_projects|easybuilder-pro)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(documents|download|weintek_drivers|weintek_libraries|weintek_projects|upload_files)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(documents|download|weintek_drivers|weintek_libraries|weintek_projects|abacus)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(abacus)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(include_utf_8)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(newslist)\/*.*/i";
    //$regexp_folders_include = "/^\/\/(upload_files)\/*.*/i";
    $regexp_files_include = "/\.(htaccess|js|css|php|html|xml|txt|jpg|png|svg|webp|gif|woff2|ttf|package)$/i";
    //$regexp_files_include = "/(usdrate.txt|get_usd_rate.php)$/i";
    //$regexp_files_include = "/\.(htaccess)$/i";
    //$regexp_files_include = "/inc_data_preparator\.php$/i";
    //$regexp_files_include = "/redirect\.php$/i";
    //$regexp_files_include = "/robots\.txt$/i";
    $regexp_files_exclude = "/dbcon.php|settings.php/";

    $dir_handle = opendir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir );
    while ( $file = readdir( $dir_handle ) ) {
      $file = iconv( 'UTF-8', 'UTF-8//IGNORE', utf8_encode( $file ) );
      if ( $file != ".." && $file != "." && is_dir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file ) ) {
        if ( preg_match( $regexp_folders_exclude, $in_dir ) ) {
          file_put_contents( "exclude_folders.txt", $in_dir . "\n", FILE_APPEND | LOCK_EX );
        } else {
          $this->find( $in_dir . "/" . $file );
        }
      }
      if ( is_file( $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file ) && $file != ".." && $file != "." ) {
        if ( $regexp_folders_include != "" ) {
          if ( preg_match( $regexp_files_include, $file )AND preg_match( $regexp_folders_include, $in_dir )AND!preg_match( $regexp_folders_exclude, $in_dir )AND!preg_match( $regexp_files_exclude, $file ) ) {
            $this->a_fname[ $this->cofiles ] = $file;
            $this->a_fsize[ $this->cofiles ] = filesize( $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file );
            $this->a_hash_file[ $this->cofiles ] = hash_file( "md5", $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file );
            $this->a_fdir[ $this->cofiles ] = $in_dir;
            $this->cofiles++;
            if ( $this->cofiles > 50000 ) break;
          }
		} else {
            if ( preg_match( $regexp_files_include, $file )AND!preg_match( $regexp_folders_exclude, $in_dir )AND!preg_match( $regexp_files_exclude, $file ) ) {
              $this->a_fname[ $this->cofiles ] = $file;
              $this->a_fsize[ $this->cofiles ] = filesize( $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file );
              $this->a_hash_file[ $this->cofiles ] = hash_file( "md5", $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $in_dir . "/" . $file );
              $this->a_fdir[ $this->cofiles ] = $in_dir;
              $this->cofiles++;
              if ( $this->cofiles > 50000 ) break;
            }
          }
        }
      }
      closedir( $dir_handle );
    }
  }