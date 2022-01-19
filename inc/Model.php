<?php


class Model
{
	protected $App;
	protected $db;
	protected $fields;
	protected $collectionName; // Таблица\коллекция в БД

	protected $allowed = []; // Допущенные в модели поля


	// Обязательно нужен контекст приложения, через него всё...
	function __construct($App)
	{
		$this->App = $App;
		$this->db = &$this->App->db;

		foreach ($this->allowed as $val) {
			$this->setField($val, '');
		}
	}

	// Устанавливает значения поля, не взирая на разрешённость У наследника $this->allowed
	function setField($fieldName, $value)
	{
		// Забыл что поиск то про типы в БД... Придётся так изощряться
		// Пытаюсь привести все строки к числу, используя динамическое преобразование и сравнение
		if(gettype($value) === 'string') {
			$int_value = (int) $value;
			if((string) $int_value === $value) {
				/*var_dump((int) $value);
				var_dump($value);
				var_dump($fieldName);
				var_dump(gettype($value));
				echo "<hr>";*/
				$value = (int) $int_value;
			}
		}
		$this->fields[$fieldName] = $value;
	}

	// Возвращает поле модели
	function getField($fieldName)
	{
		return isset($this->fields[$fieldName]) ? $this->fields[$fieldName] : '';
	}

	// Возвращает все поля модели
	function fieldsArray()
	{
		return $this->fields;
	}

	// Наполняет модель полями разрешёнными
	function fill($array)
	{
		foreach ($array as $fieldName => $value) {
			if (in_array($fieldName, $this->allowed)) {
				$this->setField($fieldName, $value);
			}
		}

		return $this;
	}

	// Подготавливает список для построения селект бара, странная штука...
	function prepareSelect($array, $value_key, $current_value, $label_key)
	{
		$prepared = [];
		foreach ($array as $item) {
			if (isset($item[$value_key])) {
				$prepared[] = [
					'value' => (string)$item[$value_key],
					'text' => isset($item[$label_key]) ? $item[$label_key] : $item[$value_key],
					'current' => (string)$item[$value_key] === $current_value
				];
			}
		}
		return $prepared;
	}

	// Считает выборку по ключу и значению
	function count($key, $value)
	{
		$collection = $this->db->{$this->collectionName};
		return $collection->count([$key => $value]);
	}

	// Записывает в BD состояние модели
	function save()
	{

		$fields = $this->fieldsArray();
		$collection = $this->db->{$this->collectionName};
		if (empty($fields['_id'])) {
			unset($fields['_id']);
			$result = $collection->insertOne($fields);
			return $result->getInsertedId();
		} else {
			$id = $fields['_id'];
			unset($fields['_id']);
			$collection->updateOne(
				['_id' => new MongoDB\BSON\ObjectId($id)],
				['$set' => $fields]
			);
			return $id;
		}
	}

	// Получаем список моделей(массив тупо) из БД
	function getList($find = [], $options = [], $limit = 9999, $skip = 0)
	{

		if ($limit != 0) {
			$options['limit'] = $limit;
		}

		if ($skip != 0) {
			$options['skip'] = $skip;
		}

		$collection = $this->db->{$this->collectionName};

		if (!empty($find) || !empty($options)) {
			$result = $collection->find($find, $options)->toArray();
		} else {
			$result = $collection->find()->toArray();
		}

		return $result;
	}

	// Ищем по ID. тут всё ясно...
	function findById($id)
	{
		$collection = $this->db->{$this->collectionName};
		$document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		$this->fill($document);
		return $this;
	}

	// Ну тоже ясно, удаляем по ID
	function removeById($id)
	{
		$collection = $this->db->{$this->collectionName};
		$deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		return $deleteResult->getDeletedCount();
	}

}