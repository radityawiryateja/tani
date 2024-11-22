<!-- require handlers -->
<?php $this->load->view('js/utils/bufferHandler') ?>
<?php $this->load->view('js/utils/errorHandler') ?>
<?php $this->load->view('js/utils/modalHandler') ?>
<?php $this->load->view('js/utils/formSubmitHandler') ?>

<script>
	let mainSaveConfig

	if (config.formConfig) {
		mainSaveConfig = { url: config.baseURL + 'save', ...config.formConfig}
	} else {
		mainSaveConfig = { url: config.baseURL + 'save' }
	}

	save(mainSaveConfig)
</script>