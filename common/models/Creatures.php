<?php

Yii::import('application.models._base.BaseCreatures');

class Creatures extends BaseCreatures
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function searchFront() {
		$criteria = new CDbCriteria;
		$sort = new CSort;
		$sort->defaultOrder = 'ID DESC';
		$criteria->compare('ID', $this->ID);
		$criteria->compare('Viet', $this->Viet, true, 'OR');
		$criteria->compare('Latin', $this->Viet, true, 'OR');
		$criteria->compare('Loai', $this->Loai);
		$criteria->compare('Ho', $this->Ho);
		$criteria->compare('Bo', $this->Bo);
		$criteria->compare('Nhom', $this->Nhom);
		$criteria->compare('Description', $this->Description, true);
		$criteria->compare('Img', $this->Img, true);
		$criteria->compare('Author', $this->Author);
		$criteria->compare('AuthorName', $this->AuthorName, true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => $sort,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}


	public function afterSave() {
		parent::afterSave( );
		$this->addImages( );
	}

	public function addImages( ) {
		$url ="";
		if($this->Loai == 1) {
			$url = 'animal';
		}
		else if($this->Loai == 2) {
			$url = 'plant';
		}
		else if($this->Loai == 3) {
			$url = 'insect';
		}

		//If we have pending images
		if( Yii::app( )->user->hasState( 'images' ) ) {
			$userImages = Yii::app( )->user->getState( 'images' );
			//Resolve the final path for our images
			$path = Yii::app( )->getBasePath( )."/../frontend/www/images/pictures/$url/";
			//Create the folder and give permissions if it doesnt exists
			if( !is_dir( $path ) ) {
				mkdir( $path );
				chmod( $path, 0777 );
			}

			$i = 0;
			//Now lets create the corresponding models and move the files
			foreach( $userImages as $image ) {
				if( is_file( $image["path"] ) ) {
					if($i == 0)
						$image["filename"] = $this->ID.".".$image['ext'];
					else
					{
						$image["filename"] = $this->ID."_".$i.".".$image['ext'];
					}
					$i++;
					if( rename( $image["path"], $path.$image["filename"] ) ) {
						chmod( $path.$image["filename"], 0777 );
						$this->isNewRecord = false;
						$this->saveAttributes(array("Img" => $this->ID));
						/* $img = new Image( );
						 $img->size = $image["size"];
						$img->mime = $image["mime"];
						$img->name = $image["name"];
						$img->source = $path.$image["filename"];
						$img->somemodel_id = $this->id;
						if( !$img->save( ) ) {
						//Its always good to log something
						Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString(
								$img->getErrors( ) ), CLogger::LEVEL_ERROR );
						//this exception will rollback the transaction
						throw new Exception( 'Could not save Image');
						} */
					}
				} else {
					//You can also throw an execption here to rollback the transaction
					Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
				}
			}
			//Clear the user's session
			Yii::app( )->user->setState( 'images', null );
		}
	}
}