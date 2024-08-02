<?php
namespace Model;
  
class Snippet extends \Fuwafuwa\BaseModel {

  function __construct(\Fuwafuwa\Db $db) {
    parent::__construct($db, 'snippet', ['ai_field' => 'id', 'modified_field' => 'updated', ]);
    
    // https://github.com/rakit/validation
    // $this->validation = [ 
    //   'rules' => [
    //   ],
    //   'custom_message' => [
    //   ]
    // ];    
    
    // $this->preProcess = function(array $data): array {
    //   // do something to data before insert/update
    //   return $data;
    // };    

    // $this->preCreate = function(self $self, array $pkeys): void { };    
    // $this->preUpdate = function(self $self, array $pkeys): void { 
    //   // Delete associated file
    //   if($self->changed('field_name')) {
    //     if (file_exists($self['field_name'])) {
    //       unlink($self['field_name']);
    //     } 
    //   }
    // };    
    // $this->preDelete = function(self $self, array $pkeys): void {
    //   // Delete associated file
    //   if (file_exists($self['field_name'])) {
    //     unlink($self['field_name']);
    //   } 
    // };    
    // $this->postCreate = function(self $self, array $pkeys): void { };    
    // $this->postUpdate = function(self $self, array $pkeys): void { };    
    // $this->postDelete = function(self $self, array $pkeys): void { };    
    
    // $this->postView = function(array $data): array {
    //   // do something to SQL, usually for increase view count
    //   return $data;
    // };    
  }
  
}