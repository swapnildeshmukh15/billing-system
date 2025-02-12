import AppFunction from "../../core/helpers/app/AppFunction";
import { RECEIPTHISTORY } from "../Config/BillarApiUrl";
import {
  formatDateToLocal,
  numberWithCurrencySymbol,
} from "../Helpers/Helpers";
import { DeleteMixins, ModalMixins } from "./billar/DeleteMixins";
import { FormMixin } from "../../core/mixins/form/FormMixin";
import { paymentMethods } from "./FilterMixin";
import { urlGenerator } from "../Helpers/AxiosHelper";

export default {
  mixins: [FormMixin, DeleteMixins, ModalMixins, paymentMethods],
  data() {
    return {
      tableId: "receipts-table",
      receiptSummation: {},
      numberWithCurrencySymbol,
      options: {
        url: RECEIPTHISTORY,
        name: this.$t("payments_table"),
        filters: [
          {
            title: this.$t("created"),
            type: "range-picker",
            key: "date",
            option: ["today", "thisMonth", "last7Days", "nextYear"],
          },
          {
            title: this.$t("payment_methods"),
            type: "checkbox",
            key: "payment_methods",
            option: [],
            permission: this.$can("show_all_data") ? true : false,
          },
          {
            title: this.$t("amount"),
            type: "range-filter",
            key: "amount_range",
            minTitle: this.$t("minimum_amount"),
            maxTitle: this.$t("maximum_amount"),
            maxRange: 100,
            minRange: 0,
            permission: this.$can("show_all_data") ? true : false,
          },
        ],
        columns: [
          {
            title: this.$t("invoice_number"),
            type: 'custom-html',
            key: "payment_id",
            modifier: (value, row) => {
              console.log("Row: ", row);
              return this.$can('show_all_data') ?
                `<a onclick="window.open(this.href,'_blank');return false;" href="${urlGenerator(`receipt/${row.id}/details`)}"> ${+row.payment.invoice.invoice_number}</a>`
                :
                `<p> ${+row.payment.invoice.invoice_number}</p>`
                ;
            }
          },
          {
						title: this.$t('client'),
						type: 'text',
						key: 'client_name',
						isVisible: !!this.$can('show_all_data')
					},
          {
            title: this.$t("from"),
            type: "text",
            key: "from",
            isVisible: !!this.$can("show_all_data"),
          },
          {
            title: this.$t("to"),
            type: "text",
            key: "to",
            isVisible: !!this.$can("show_all_data"),
          },
          {
            title: this.$t("date"),
            type: "object",
            key: "date",
            modifier: (date) => formatDateToLocal(date),
          },
          {
            title: this.$t("payment_method"),
            type: "object",
            key: "payment_method",
            modifier: (payment_method) =>
              payment_method ? payment_method.name : "",
          },
          {
            title: this.$t("amount"),
            type: "object",
            key: "amount",
            modifier: (amount) => numberWithCurrencySymbol(amount),
          },
        ],
        actions: [
          {
            title: this.$t("edit"),
            type: "edit",
            modifier: () => this.$can("update_payment_histories"),
          },
          {
            title: this.$t("view"),
            type: "view",
            url: AppFunction.getAppUrl("/receipt-details"),
            modifier: () => (this.$can("show_all_data") ? true : false),
          },
          {
            title: this.$t("action_invoice_download"),
            type: "download",
            modifier: () => this.$can("invoice_download"),
          },
          {
            title: this.$t("delete"),
            type: "delete",
            modifier: () => this.$can("delete_payment_histories"),
          },
        ],
        rowLimit: 10,
        orderBy: "desc",
        responsive: true,
        showHeader: true,
        showFilter: true,
        showSearch: true,
        showAction: true,
        tableShadow: true,
        actionType: "dropdown",
        datatableWrapper: true,
        paginationType: "pagination",
      },
    };
  },
  methods: {
    getListAction(rowData, actionObj) {
      this.selectUrl = `${RECEIPTHISTORY}/${rowData.id}`;
      if (actionObj.title === this.$t("edit")) {
        this.isModalActive = true;
      } else if (actionObj.type === "view") {
        this.selectUrl = AppFunction.getAppUrl(
          `/receipt/${rowData.id}/details`
        );
        window.location = this.selectUrl;
      } else if (actionObj.type === "download") {
        window.open(AppFunction.getAppUrl(`receipt-download/${rowData.id}`));
      } else if (actionObj.title === this.$t("delete")) {
        this.confirmationModalActive = true;
      }
    },
    getTableMediaAction() {
      this.$hub.$on("getTableMediaAction", (data) => {
        this.viewInvoiceDetails();
      });
    },
    PaymentRangeFilter() {
      this.axiosGet(`payment-range-filter`).then((response) => {
        let amountValueFilter = this.options.filters.find(
          (item) => item.key === "amount_range"
        );

        amountValueFilter.maxRange = response.data.max_amount;
        amountValueFilter.minRange =
          response.data.min_amount < response.data.min_amount
            ? response.data.max_amount
            : 0;
      });
    },

    getPaymentSummation() {
      this.axiosGet(`payment-summation`).then((response) => {
        this.paymentSummation = response.data;
      });
    },
  },
  mounted() {
    this.getTableMediaAction();
    this.$store.dispatch("getInvoice");
    if (this.$can("show_all_data")) {
      this.PaymentRangeFilter();
    }
  },
  created() {
    if (
      this.$can("update_payment_histories") ||
      this.$can("delete_payment_histories")
    ) {
      this.options.columns = [
        ...this.options.columns,
        {
          title: this.$t("action"),
          type: "action",
          key: "receipt",
          isVisible: true,
        },
      ];
    }
    this.getPaymentSummation();
  },
};