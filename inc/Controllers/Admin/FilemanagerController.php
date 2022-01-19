<?php



namespace Controllers\Admin;

use Controller;


class FilemanagerController extends Controller
{
	private $root;
	/**
	 * @var string
	 */
	private $dir;
	/**
	 * @var array
	 */
	private $files;
	/**
	 * @var array
	 */
	private $directories;
	private $url;

	function index($params) {
		$this->root = $_SERVER['DOCUMENT_ROOT'] . $this->App->sittings['fileStoragePath'];
		$this->url = $this->App->sittings['fileStoragePath'];

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(!empty($_POST['new-folder'])) {

				$newDir = $this->root . $_POST['new-folder'];
				if(!is_dir($newDir)) {
					mkdir($newDir);
					return '{"result":"true","folder":"'.$newDir.'"}';
				} else {
					return '{"error":"Директория уже существует: '.$_POST['new-folder'].'"}';
				}
			}


			if(!empty($_FILES['upload_file'])) {
				$pathto = $this->root . $_POST['path'] . $_FILES['upload_file']['name'] ;
				$isUpload = move_uploaded_file( $_FILES['upload_file']['tmp_name'], $pathto);

				return '{"result":"'.$isUpload.'"}';
			}

		} else {
			echo $this->getPath($params);
		}
	}


	protected function getPath($params) {
		$this->files = [];
		$this->directories = [];
		$this->dir = $this->root . $params;
		if(!is_dir($this->dir)) {
			return '{"error":"Нет такой директории: '.$this->dir.'"}';
		}

		foreach(scandir($this->dir) as $item) {
			$itemPath = $this->dir . $item;
			$itemUrl  = $this->url . $item;

			if(is_dir($itemPath) && $item != '.' && $item != '..') {
				$this->directories[] = [
					"path" => $itemPath,
					"url" => $itemUrl,
					"name" => $item
				];
			}

			if(is_file($itemPath)) {
				if(@is_array(getimagesize($itemPath))){
					$image = true;
				} else {
					$image = false;
				}
				$this->files[] = [
					"path" => $itemPath,
					"url"  => $itemUrl,
					"name" => $item,
					"size" => filesize_format(filesize($itemPath)),
					"is_image" => $image
				];
			}
		}

		return json_encode(["files" => $this->files, "directories" => $this->directories]);
	}
}