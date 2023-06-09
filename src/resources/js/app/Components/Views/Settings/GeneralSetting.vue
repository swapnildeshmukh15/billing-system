<template>
    <div class="general-setting">
        <app-overlay-loader v-if="preloader"/>
        <form v-else ref="form" data-url="/admin/app/settings" enctype="multipart/form-data"
              class="mb-0"
              :class="{'loading-opacity': preloader}">
            <!-- Company Info -->
            <fieldset class="form-group mb-5">
                <legend class="text-size-15 text-primary pt-0 mb-3">
                    {{ $t('company_info') }}
                </legend>
                <div>
                    <div class="form-group row">
                        <label for="appSettingsCompanyName" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('company_name') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsCompanyName"
                                type="text"
                                v-model="appSettings.company_name"
                                :placeholder="$t('type_your_company_name')"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsCompanyLogo" class="col-lg-3 col-xl-3 col-form-label h-fit-content">
                            {{ $t('company_logo') }}<br>
                            <small class="text-muted font-italic">
                                {{ $t('recommended_company_logo_size') }}
                            </small>
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsCompanyLogo"
                                type="custom-file-upload"
                                :generate-file-url="false"
                                @change="companyLogo = true"
                                v-model="appSettings.company_logo"
                                :label="$t('change_logo')"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsCompanyIcon" class="col-lg-3 col-xl-3 col-form-label h-fit-content">
                            {{ $t('company_icon') }}<br>
                            <small class="text-muted font-italic">
                                {{ $t('recommended_company_icon_size') }}
                            </small>
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsCompanyIcon"
                                type="custom-file-upload"
                                :generate-file-url="false"
                                @change="companyIcon = true"
                                v-model="appSettings.company_icon"
                                :label="$t('change_icon')"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsCompanyBanner"
                               class="col-lg-3 col-xl-3 col-form-label h-fit-content">
                            {{ $t('company_banner') }}<br>
                            <small class="text-muted font-italic">
                                {{ $t('recommended_company_banner_size') }}
                            </small>
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsCompanyBanner"
                                type="custom-file-upload"
                                :generate-file-url="false"
                                @change="companyBanner = true"
                                v-model="appSettings.company_banner"
                                :label="$t('change_banner')"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsLanguage" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('language') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsLanguage"
                                type="select"
                                v-model="appSettings.language"
                                :list="languageList"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsTimeFormat" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('layout') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <div>
                                <div class="note note-warning p-4 mb-primary clearfix">
                                    <p class="m-1">{{ $t('layout_description') }}</p>
                                </div>
                            </div>
                            <app-input
                                id="appSettingsLayout"
                                type="radio-buttons"
                                v-model="appSettings.layout"
                                :list="layouts"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsTimeFormat" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('vat_number') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsLayout"
                                type="text"
                                :placeholder="$t('vat_number')"
                                v-model="appSettings.vat_number"
                            />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="appSettingsTimeFormat" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('company_terms') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsLayout"
                                type="textarea"
                                :placeholder="$t('company_terms')"
                                v-model="appSettings.company_terms"
                                :cols = "15"
                                :rows ="15"
                            />
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Date & Time Setting -->
            <fieldset class="form-group mb-5">
                <legend class="text-size-15 text-primary pt-0 mb-3">
                    {{ $t('date_and_time_setting') }}
                </legend>
                <div>
                    <div class="form-group row">
                        <label for="appSettingsDateFormat" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('date_format') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsDateFormat"
                                type="select"
                                v-model="appSettings.date_format"
                                :list="dateFormats"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsTimeFormat" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('time_format') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsTimeFormat"
                                type="radio-buttons"
                                v-model="appSettings.time_format"
                                :list="timeFormats"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsTimeZone" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('time_zone') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsTimeZone"
                                type="select"
                                v-model="appSettings.time_zone"
                                :list="timeZones"
                            />
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Currency Settings -->
            <fieldset class="form-group mb-5">
                <legend class="text-size-15 text-primary pt-0 mb-3">
                    {{ $t('currency_setting') }}
                </legend>
                <div>
                    <div class="form-group row">
                        <label for="appSettingsCurrencySymbol" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('currency_symbol') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <div>
                                <div class="note note-warning p-4 mb-primary clearfix">
                                    <p class="m-1">{{ $t('currency_description') }}</p>
                                </div>
                            </div>
                            <app-input
                                id="appSettingsCurrencySymbol"
                                type="text"
                                v-model="appSettings.currency_symbol"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsDecimalSeparator" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('decimal_separator') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsDecimalSeparator"
                                type="radio-buttons"
                                v-model="appSettings.decimal_separator"
                                @input="changeValue('decimal_separator')"
                                :list="decimalSeparators"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsThousandSeparator" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('thousand_separator') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsThousandSeparator"
                                type="radio-buttons"
                                v-model="appSettings.thousand_separator"
                                @input="changeValue('thousand_separator')"
                                :list="thousandSeparators"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsNumberOfDecimal" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('number_of_decimal') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsNumberOfDecimal"
                                type="radio-buttons"
                                v-model="appSettings.number_of_decimal"
                                :list="numberOfDecimals"
                                :required="true"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appSettingsCurrencyPosition" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('currency_position') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="appSettingsCurrencyPosition"
                                type="radio-buttons"
                                v-model="appSettings.currency_position"
                                :list="currencyPositions"
                                :required="true"
                            />
                        </div>
                    </div>
                </div>
            </fieldset>
            <!--Other settings-->
            <fieldset class="form-group mb-5">
                <legend class="text-size-15 text-primary pt-0 mb-3">
                    {{ $t('other_setting') }}
                </legend>
                <div>
                    <div class="form-group row">
                        <label for="invoiceNote" class="col-lg-3 col-xl-3 col-form-label">
                            {{ $t('invoice_note') }}
                        </label>
                        <div class="col-lg-8 col-xl-8">
                            <app-input
                                id="invoiceNote"
                                type="textarea"
                                :placeholder="$t('invoice_note')"
                                v-model="appSettings.invoice_note"
                            />
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="mt-5 action-buttons" v-if="$can('update_settings')">
                <button class="btn btn-primary mr-2" @click.prevent="submit">
                    {{ $t('save') }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import * as actions from '../../../Config/ApiUrl';
    import {SettingsStoreMixin} from './Mixins/SettingsStoreMixin';
    import {FormMixin} from '../../../../core/mixins/form/FormMixin';
    import {formDataAssigner} from "../../../Helpers/Helpers";

    export default {
        name: 'GeneralSetting',
        mixins: [FormMixin, SettingsStoreMixin],
        data() {
            return {
                preloader: false,
	            companyLogo: false,
	            companyIcon: false,
	            companyBanner: false,
                dateFormats: [],
                timeFormats: [],
                timeZones: [],
                decimalSeparators: [],
                numberOfDecimals: [],
                thousandSeparators: [],
                currencyPositions: [],
                layouts: [],
            }
        },
        created() {
            this.data();
            this.$store.dispatch('getSettings');
        },
        computed: {
            languageList() {
                return this.$store.state.settings.languages
            },
        },
        methods: {
            changeValue(type) {
                if (type === 'thousand_separator') {
                    if (this.appSettings.thousand_separator === ',') {
                        this.appSettings.decimal_separator = '.'
                    } else if (this.appSettings.thousand_separator === '.') {
                        this.appSettings.decimal_separator = ','
                    }
                } else {
                    this.appSettings.thousand_separator = this.appSettings.decimal_separator === ',' ? '.' : ','
                }
            },
            data() {
                this.preloader = true;
                this.axiosGet(actions.GENERAL_SETTINGS).then(response => {
                    this.currencyPositions = response.data.currency_position;
                    this.dateFormats = response.data.date_format;
                    this.decimalSeparators = response.data.decimal_separator;
                    this.numberOfDecimals = response.data.number_of_decimal;
                    this.thousandSeparators = response.data.thousand_separator;
                    this.timeFormats = response.data.time_format;
                    this.timeZones = response.data.time_zones;
                    this.layouts = response.data.layouts;
                }).catch(({response}) => {
                }).finally(() => {
                    this.preloader = false;
                });
            },
            beforeSubmit() {
                this.preloader = true;
            },
            submit() {
	            if (this.companyLogo === false) {
		            delete this.appSettings.company_logo;
	            }
	            if (this.companyIcon === false) {
		            delete this.appSettings.company_icon;
	            }
	            if (this.companyBanner === false) {
		            delete this.appSettings.company_banner;
	            }
	            let formData = formDataAssigner(new FormData, this.appSettings);
	            this.save(formData);
            },
            afterSuccess(res) {
                this.$toastr.s(res.data.message);
                window.location.reload();
            },
            afterFinalResponse() {
                this.preloader = false;
            },
            afterError(res) {
                this.$toastr.e(res.data.message);
            }
        }
    }
</script>
