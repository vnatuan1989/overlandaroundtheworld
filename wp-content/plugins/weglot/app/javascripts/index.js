import InitAdminSelect from './settings/admin-select'
import InitAdminWeglotBox from './settings/admin-weglot-box'
import InitAdminExclusion from './settings/admin-exclusion'
import InitAdminButtonPreview from './settings/admin-button-preview'
import InitAdminCheckApiKey from './settings/admin-check-api-key'
import InitAdminChangeCountry from './settings/admin-change-country'
import InitAdminPreventSaveForm from './settings/admin-prevent-save-form'
import InitAdminPrivateMode from './settings/admin-private-mode'
import './find-polyfill'
import './filter-polyfill'

InitAdminSelect()
InitAdminExclusion();
InitAdminWeglotBox();
InitAdminButtonPreview();
InitAdminCheckApiKey();
InitAdminChangeCountry();
InitAdminPreventSaveForm();
InitAdminPrivateMode();
