<!-- require handlers -->
<?php $this->load->view('js/utils/bufferHandler') ?>
<?php $this->load->view('js/utils/errorHandler') ?>
<?php $this->load->view('js/utils/formSubmitHandler') ?>

<script>
	let mainSaveConfig

	if (config.formConfig) {
		mainSaveConfig = { url: config.baseURL + 'save', ...config.formConfig}
	} else {
		mainSaveConfig = { url: config.baseURL + 'save' }
	}

	save(mainSaveConfig)

	<?php if (isset($context)) : ?>
		$('.optional-on-update').each((i, el) => {
			$(el).hide()
		})
	<?php endif ?>
</script>