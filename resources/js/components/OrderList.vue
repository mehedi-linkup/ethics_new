<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="searchBy">
                                        <option value="pending">Pending</option>
                                        <option value="processing">On Processing </option>
                                        <option value="delivery">Delivery</option>
                                        <option value="cancel">Cancel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="dateFrom" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="dateTo" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-info btn-sm shadow-none px-3">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" :style="{ display: orders.length > 0 ? '' : 'none' }">
                    <table class="table table-bordered m-0">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;">
                                    Sl
                                </th>
                                <th style="text-align: center; width: 10%;color:white;">
                                    #Invoice
                                </th>
                                <th style="text-align: center; width: 10%;color:white;">
                                    Date
                                </th>
                                <th style="text-align: center;color:white;">
                                    Customer Details
                                </th>
                                <th style="text-align: center;color:white;">
                                    Amount Details
                                </th>
                                <th style="text-align: center;color:white;">Order Status</th>
                                <th style="text-align: center; width: 12%;color:white;">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr @dblclick="showDetails(item)"
                                    title="If you double click on this row then you can see details" :style="{
                                        background:
                                            item.status == 'delivary'
                                                ? '#ffcf87a6'
                                                : '',
                                    }">
                                    <td class="text-center" style="width: 5%">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.invoice }}
                                    </td>
                                    <td class="text-center">
                                        {{ formatDate(item.date) }}
                                    </td>
                                    <td>
                                        <span>Customer Name:
                                            {{ item.name }}</span><br />
                                        <span>Mobile: {{ item.mobile }}</span><br />
                                        <span>Address:
                                            {{ item.shipping_address }}</span>
                                    </td>
                                    <td>
                                        <span>SubTotal: {{ item.subtotal }}</span><br />
                                        <span>Total: {{ item.total }}</span><br />
                                        <span>Shipping Cost:
                                            {{ item.shipping_charge }}</span>
                                    </td>
                                    <td>
                                        <span class="text-capitalize">{{
                                            item.status
                                        }}</span>
                                    </td>
                                    <td style="width: 25%">
                                        <div class="input-group gap-2">
                                            <button title="Order Details" @click="showDetails(item)" type="button" style="background: gainsboro;border-radius: 15%; " class="shadow-none outline-none border-0">
                                                <i class="fas fa-info-circle text-primary"></i>
                                            </button>
                                            <button title="Order Cancel" v-if="item.status != 'cancel' && item.status != 'delivery' " @click="InvoiceDelete(item.id)" type="button" style="background: none" class="shadow-none outline-none border-0">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                            <button title="Order Edit" v-if="item.status != 'cancel' && item.status != 'delivery' " @click="OrderEdit(item)" type="button" style="background: none" class="shadow-none outline-none border-0">
                                                <i class="fas fa-edit text-info"></i>
                                            </button>
                                            <a :href="`${'/admin/order/invoice/'+item.invoice}`" target="_blank" title="Order Invoice" style="background: none" class="shadow-none outline-none border-0">
                                                <i class="fas fa-file text-info"></i>
                                            </a>
                                            <button @click="changeStatus(item, 'processing') " v-if=" item.status == 'pending' " type="button" :style="{background: item.status == 'pending' ? 'red' : '' }" class="text-white shadow-none outline-none border-0">Proccessing</button>
                                            <button @click="changeStatus( item, 'delivery' ) " v-else-if="item.status == 'shiped' " type="button" :style="{background: item.status == 'shiped' ? 'green' : '' }" class="text-white shadow-none outline-none border-0">Delivery</button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="card-body" :style="{ display: orders.length > 0 ? 'none' : '' }">
                    <p class="m-0 text-center">Not Found Data in Table</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <Invoicemodal :title="'Order Details'" :invoice-data="modalData"></Invoicemodal>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditOrder" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <Orderedit :title="'Order Edit Invoice'" :invoice-data="modalData"></Orderedit>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import Invoicemodal from "../components/Invoicemodal.vue";
import OrderEdit from "./OrderEdit.vue";
export default {
    components: {'Invoicemodal': Invoicemodal, 'Orderedit': OrderEdit},
    data() {
        return {
            searchBy: "pending",
            dateFrom: moment().format('YYYY-MM-DD'),
            dateTo: moment().format('YYYY-MM-DD'),
            orders: [],
            modalData: {},
            showTd: false,
        };
    },

    created() {
        this.getOrder();
    },

    methods: {
        getOrder() {
            let data = {
                searchBy: this.searchBy,
                dateFrom: this.dateFrom != "" ? this.dateFrom : "",
                dateTo: this.dateTo != "" ? this.dateTo : "",
            };

            axios.post("/admin/order/fetch", data).then((res) => {
                this.orders = res.data.orders;
            });
        },

        changeStatus(rowData, value) {
            rowData.Status = value;
            if (confirm("Are you sure!")) {
                axios.post("/admin/order/status", rowData).then((res) => {
                    $.notify(res.data, "success");
                    this.getOrder();
                });
            }
        },

        OrderEdit(rowData){
            $("#EditOrder").modal("show");
            this.modalData = rowData;
        },

        InvoiceDelete(id) {
            if (confirm("Are you sure want to delete")) {
                axios.post("/admin/order/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getOrder();
                });
            }
        },

        showDetails(rowData) {
            $("#myModal").modal("show");
            this.modalData = rowData;
        },

        formatDate(date) {
            return moment(date).format("DD-MM-YYYY");
        },
    },
};
</script>

<style>
#invoice [role="combobox"] {
    padding: 0 !important;
}
</style>
