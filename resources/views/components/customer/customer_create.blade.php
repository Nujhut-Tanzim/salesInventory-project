<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Customer</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerName">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmail">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobile">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
    async function Save()
    {
        
        let name=document.getElementById("customerName").value;
        let email=document.getElementById("customerEmail").value;
        let mobile=document.getElementById("customerMobile").value;

        if(name.length===0)
        {
            errorToast("Name is required");
        }
        else if(email.length===0)
        {
            errorToast("Email is required");
        }
        else if(mobile.length===0)
        {
            errorToast("Mobile is required");
        }
        else
        {
        document.getElementById("modal-close").click();    
        showLoader();
        let res=await axios.post("/create-customer",{
            name:name,
            email:email,
            mobile:mobile,
        });
        hideLoader();
        if(res.status===201)
        {
            successToast("Add Customer Successfully");
            document.getElementById("save-form").reset();
            await getCustomerList();
        }
        else
        {
            errorToast("Add Customer Failed");
        }
    }
    }
</script>
