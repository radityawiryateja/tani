<script>
  const dataTableInitializer = (() => {
    const tables = {}

    const initTable = config => {
      const table = config.table
      const metaData = {
        paginationWrapper: table.paginationWrapper ?? '#pagination-wrapper',
        displayTo: table.displayTo ?? '#table-result',
        filtersIdentifier: {
          inputKeyword: table.inputKeyword ?? 'input[name="keyword"]',
          selectSearchBy: table.selectSearchBy ?? 'select[name="search-by"]',
          selectPerPage: table.selectPerPage ?? 'select[name="per-page"]'
        }
      }

      tables[table.name] = pageNo => {
        loadTable(pageNo, config, metaData)
      }

      $(document).ready(() => {
        let debounceTimer

        if (table.extendsFiltersEl) {
          table.extendsFiltersEl(config)
        }

        if (table.inputKeyword !== 'disabled') {
          $(`${metaData.filtersIdentifier.inputKeyword}`).on('keyup', function() {
            clearTimeout(debounceTimer)
            debounceTimer = setTimeout(() => loadTable(0, config, metaData), 500)
          })
        }

        if (table.selectSearchBy !== 'disabled') {
          $(`${metaData.filtersIdentifier.selectSearchBy}`).on('change', () => {
            loadTable(0, config, metaData)
          })
        }

        if (table.selectPerPage !== 'disabled') {
          $(`${metaData.filtersIdentifier.selectPerPage}`).on('change', () => {
            loadTable(0, config, metaData)
          })
        }

        $(`${metaData.paginationWrapper}`).on('click', 'a', function(e) {
            e.preventDefault()
            const pageNo = $(this).attr('data-ci-pagination-page')

            if (pageNo) {
              loadTable(pageNo, config, metaData)
            }
        })
        
        loadTable(0, config, metaData)
      })

    }
    
    const loadTable = (pageNo, config, metaData) => {
      $(`${metaData.paginationWrapper}`).html('')

      displayTableSpinner(config.table.columnTotal, metaData)

      let tableFilters
      const tableURL = config.table.url ? config.table.url : config.baseURL + 'load_table'

      if (config.table.extends && config.table.extends.filters) {
        tableFilters = {
          per_page: config.selectPerPage !== 'disabled' ? $(`${metaData.filtersIdentifier.selectPerPage}`).val() : '',
          keyword: config.inputKeyword !== 'disabled' ? $(`${metaData.filtersIdentifier.inputKeyword}`).val() : '',
          search_by: config.selectSearchBy !== 'disabled' ? $(`${metaData.filtersIdentifier.selectSearchBy}`).val() : '',
          ...config.table.extends.filters
        }
      } else {
        tableFilters = {
          per_page: config.selectPerPage !== 'disabled' ? $(`${metaData.filtersIdentifier.selectPerPage}`).val() : '',
          keyword: config.inputKeyword !== 'disabled' ? $(`${metaData.filtersIdentifier.inputKeyword}`).val() : '',
          search_by: config.selectSearchBy !== 'disabled' ? $(`${metaData.filtersIdentifier.selectSearchBy}`).val() : ''
        }
      }

      $.ajax({
        url: tableURL + '/' + pageNo,
        type: 'POST',
        data: tableFilters,
        dataType: 'JSON',
        success: response => {
          const data = response.result

          let i = response.row
          let resultHTML

          if (data.length != 0) {
            resultHTML = config.table.renderContent(data, i)
          } else {
            resultHTML = `
              <tr class="text-center">
                <td colspan="${config.table.columnTotal}">Tidak ada data</td>
              </tr>`
          }

          $(`${metaData.displayTo}`).html(resultHTML)
          $(`${metaData.paginationWrapper}`).html(response.pagination)

          if (config.table.hasOwnProperty('afterRender')) {
            config.table.afterRender(response)
          }
        },
        error: () => {
          const resultHTML = `
            <tr class="text-center">
                <td colspan="${config.table.columnTotal}">Terjadi kesalahan ketika memuat data!</td>
            </tr>`

          $(`${metaData.displayTo}`).html(resultHTML)
        }
      })
    }

    const displayTableSpinner = (columnTotal, metaData) => {
      const spinner = `
        <tr id="table-spinner">
          <td colspan="${columnTotal}">
            <div class="d-flex justify-content-center align-items-center">
              <div class="spinner-border spinner-border-sm me-2" role="status">
              </div>
              <span>Memproses...</span>
            </div>
          </td>
        </tr>`

      $(`${metaData.displayTo}`).html(spinner)
    }

    return {
      init: initTable,
      reload: tables
    }
  })()
</script>