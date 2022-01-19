var fm = {
	path: '',
	inputs: [],
	current_file: '',
	uploadFile: null,
	openModalElement: false,
	init: function() {
		document.addEventListener('DOMContentLoaded', () => {
			this.modal = new bootstrap.Modal(document.getElementById('fm-manager'))

			this.inputs = document.querySelectorAll('input.file-manager');
			this.inputs.forEach((value) => {
				this.template(value);
			});


			this.fm = document.querySelector('#fm-manager');
			this.fm_select = document.getElementById('fm-select');
			this.fm_upload = document.getElementById('fm-upload');
			this.fm_new_folder = document.getElementById('fm-new-folder');

			this.fm_select.addEventListener('click', () => {
				if(!this.current_file) {
					alert('Выберите файл из списка');
					return;
				} else {
					this.openModalElement.value = this.current_file;
					this.openModalElement.parentNode.querySelector('.file-manager__preview ').src = this.current_file;
					this.modal.hide();
				}
			});

			this.fm_upload.addEventListener('click', () => {
				this.uploadFile = document.createElement('input');
				this.uploadFile.type = 'file';
				this.uploadFile.onchange = this.onUploadFile.bind(this);
				this.uploadFile.click();
			});

			this.fm_new_folder.addEventListener('click', () => {
				var result = prompt('Имя новой папки');
				var formData = new FormData();
				formData.append("new-folder", this.path + result);
				fetch('/admin/file-manager/', {method: "POST", body: formData, keepalive: false})
					.then(response => response.json())
					.then(response => {
						if(response.error) {
							alert(response.error);
						} else {
							this.updateFm();
						}
					});
			});

			// Первоначальная загрузка
			this.updateFm();
		});
	},

	template: function (element) {
		var img = document.createElement('img');
		img.onerror = () => {
			img.src = '/templates/no-image.jpg';
			img.classList.add('file-manager__preview_error');
		};
		img.onload = () => {
			setTimeout(()=> {
				img.classList.add('file-manager__preview_load');
			}, 500);
		};
		img.classList.add('file-manager__preview');
		img.src = element.value;

		var button = document.createElement('button');
		button.type = 'button';
		button.classList.add('btn');
		button.classList.add('btn-primary');
		button.innerHTML = '<i class="bi-file-earmark-image-fill"></i> Редактировать';
		button.addEventListener('click', () => {
			this.current_file = element.value;
			this.openModalElement = element;
			this.viewFileManager();
		});

		element.after(img, button);
		element.style.display = 'none';
	},

	viewFileManager: function () {

		this.modal.show();
	},

	onUploadFile: function(e) {
		var file = e.target.files[0];
		var formData = new FormData();
		formData.append("upload_file", file);
		formData.append("path", this.path);
		fetch('/admin/file-manager/', {method: "POST", body: formData, keepalive: false})
			.then(response => response.json())
			.then(response => {
				if(response.result == '0') {
					alert('Ошибка загрузки')
				} else {
					this.updateFm();
				}
		});
	},

	templateFolders: function(directories) {
		var fm_folders_block = document.getElementById('fm-folders');
		fm_folders_block.innerHTML = '';
		directories.map((folder) => {
			fm_folders_block.innerHTML += '<div class="file-manager__folder"><i class="bi bi-folder"></i> '+folder.name+'</div>';
		});
	},

	templateFiles: function(files) {
		var fm_files_block = document.getElementById('fm-files');
		fm_files_block.innerHTML = '';
		files.map((file) => {
			var img = '';
			if(file.is_image) {
				img = '<img src="'+file.url+'">';
			}
			var current = '';
			if(this.current_file === file.url) {
				current = 'file-manager__file_current';
			}
			fm_files_block.innerHTML += '<div class="file-manager__file '+current+'" data-url="'+file.url+'">'+img+file.name+'</div>';
		});

		for(let value of fm_files_block.querySelectorAll('.file-manager__file')) {
			value.addEventListener('click', () => {
				this.current_file = value.getAttribute('data-url');

				for(let notcurrent of fm_files_block.querySelectorAll('.file-manager__file')) {
					notcurrent.classList.remove('file-manager__file_current');
				}

				value.classList.add('file-manager__file_current');
			})
		}

	},

	updateFm: function () {
		fetch('/admin/file-manager/' + this.path, {method: "GET"})
			.then(response => response.json())
			.then(response => {
				this.templateFolders(response.directories);
				this.templateFiles(response.files);
			});
	}
}

fm.init();