<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Update() {
        let id = document.getElementById("updateID").value;
        let name = document.getElementById("customerNameUpdate").value;
        let email = document.getElementById("customerEmailUpdate").value;
        let mobile = document.getElementById("customerMobileUpdate").value;

        if (name.length === 0) {
            errorToast("Name is required");
        } else if (email.length === 0) {
            errorToast("Email is required");
        } else if (mobile.length === 0) {
            errorToast("Mobile is required");
        } else {

            document.getElementById("update-modal-close").click();
            showLoader();
            let res = await axios.post("/update-customer", {
                id: id,
                name: name,
                email: email,
                mobile: mobile
            });
            hideLoader();
            if (res.data === 1) {
                successToast("Update Successful");
                document.getElementById("update-form").reset();
                await getCustomerList();
            } else {
                errorToast("Update Failed");
            }
        }
    }
</script>