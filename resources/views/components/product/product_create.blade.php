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
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value=" ">Select Category</option>
                                </select>
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productName">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPrice">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">
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
    FillCategoryDropDown();

    async function FillCategoryDropDown()
    {
        let res=await axios.get("/list-category");
        res.data.forEach(function(item,i){
            let option=`<option value="${item['id']}">${item['name']}</option>`
            $("#productCategory").append(option);
        });
    }

    async function Save()
    {
        let productCategory=document.getElementById("productCategory").value;
        let name=document.getElementById("productName").value;
        let productPrice=document.getElementById("productPrice").value;
        let productUnit=document.getElementById("productUnit").value;
        let productImg=document.getElementById("productImg").files[0];

        if(!productCategory)
        {
            errorToast("Product Category is required");
        }
        else if(name.length===0)
        {
            errorToast("Name is required");
        }
        else if(productPrice.length===0)
        {
            errorToast("Price is required");
        }
        else if(productUnit.length===0)
        {
            errorToast("Product Unit is required");
        }
        else if(!productImg)
        {
            errorToast("Product Image is required");
        }
        else
        {
        document.getElementById("modal-close").click();    
       
        let formData=new FormData();
        formData.append('img',productImg);
        formData.append('name',name);
        formData.append('price',productPrice);
        formData.append('unit',productUnit);
        formData.append('category_id',productCategory);

        const config={
            headers:{
                'content-type':'multipart/form-data'
            }
        }

        showLoader();

        let res=await axios.post("/create-product",formData,config);
        hideLoader();
        if(res.status===201)
        {
            successToast("Add product Successfully");
            document.getElementById("save-form").reset();
            await getList();
        }
        else
        {
            errorToast("Add product Failed");
        }
    }
    }
</script>
