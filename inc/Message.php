<?php


class Message
{
	const messages_types = [
		'INFO',
		'ERROR'
	];
	/**
	 * @var array
	 */
	private $messages;

	public function add($message_object, $message_type = 'INFO', $message_identity = 'SYSTEM') {
		$this->messages[$message_identity][] = [
			'OBJECT' => $message_object,
			'TYPE'   => $message_type
		];
		$_SESSION['MESSAGES'] = $this->messages;
	}

	public function find($message_identity) {
		if(!empty($this->messages[$message_identity])) {
			return $this->messages[$message_identity];
		}

		return [];
	}

	public function flush() {
		$this->messages = [];
		if(!empty( $_SESSION['MESSAGES'] )) {
			$this->messages = $_SESSION['MESSAGES'];
			$_SESSION['MESSAGES'] = [];
		}
		return $this->messages;
	}
}