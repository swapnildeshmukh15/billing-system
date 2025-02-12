import AppFunction from "../../core/helpers/app/AppFunction";
import { INVENTORY } from "../Config/BillarApiUrl";
import { FormMixin } from "../../core/mixins/form/FormMixin";
import { DeleteMixins } from "./billar/DeleteMixins";
import { formatDateToLocal } from "../Helpers/Helpers";
import { urlGenerator } from "../Helpers/AxiosHelper";

export default {
  mixins: [FormMixin, DeleteMixins],
  data() {
    return {
      AppFunction,
      tableId: "inventory-table",
      formatDateToLocal,
      options: {
        url: INVENTORY,
        name: this.$t("inventory_table"),
        filters: [
          {
            title: this.$t("created"),
            type: "range-picker",
            key: "date",
            option: ["today", "thisMonth", "last7Days", "nextYear"],
          },
        ],
        columns: [
          {
						title: this.$t('invoice_number'),
						type: 'custom-html',
						key: 'invoice_id',
						modifier: (value, row) => {
							return this.$can('view_inventories') ?
								`<a onclick="window.open(this.href,'_blank');return false;" href="${urlGenerator(`inventory/${row.id}/details`)}"> ${+row.invoice_id}</a>`
								:
								`<p> ${+row.invoice_id}</p>`
								;
						}
					},
          {
            title: this.$t("client"),
            type: "object",
            key: "invoice",
            isVisible: !!this.$can("show_all_data"),
            modifier: (invoice) => (invoice ? invoice.client_name : ""),
          },
          {
            title: "Notes",
            type: "object",
            key: "notes",
            modifier: (notes) => notes,
          },
          {
            title: "Created At",
            type: "object",
            key: "created_at",
            modifier: (created_at) => formatDateToLocal(created_at, false, false),
          },
          {
            title: this.$t("actions"),
            type: "action",
          },
        ],
        actions: [
          {
            title: this.$t("view"),
            type: "view",
            url: AppFunction.getAppUrl("/inventory-details"),
            modifier: () => (this.$can("view_inventories") ? true : false),
          },
          {
            title: this.$t("edit"),
            type: "edit",
            modifier: () => this.$can("update_inventories"),
          },
          {
            title: this.$t("delete"),
            type: "delete",
            modifier: () => this.$can("delete_inventories"),
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
      if (actionObj.type === 'view') {
				this.selectUrl = AppFunction.getAppUrl(`/inventory/${rowData.id}/details`);
				window.location = this.selectUrl;
			} else if (actionObj.type === "edit") {
        window.location.replace(
          AppFunction.getAppUrl(`${INVENTORY}/${rowData.id}/edit`)
        );
      } else if (actionObj.type === "delete") {
        this.selectUrl = `${INVENTORY}/${rowData.id}`;
        this.confirmationModalActive = true;
      }
    },
    viewInventoryDetails() {
      location.replace(AppFunction.getAppUrl("/inventory-details"));
    },
    getTableMediaAction() {
      this.$hub.$on("getTableMediaAction", (data) => {
        this.viewInventoryDetails();
      });
    },
    deleteProductFromInvoice(data) {
      this.deletedInvoiceProductContext = data;
      setTimeout(() => {
        $("#invoice-add-edit-modal").css({ opacity: ".5" });
        this.invoiceProductDeleteModal = true;
      });
    },
  },
  mounted() {
    this.getTableMediaAction();
  },
};