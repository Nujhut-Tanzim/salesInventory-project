<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Customers</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary" />
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getCustomerList();
    async function getCustomerList()
    {
        showLoader();
        let res=await axios.get("/list-customer");
        hideLoader();
        let tableList=$("#tableList");
        let tableData=$("#tableData");
        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item,index){

            let row=`<tr>
                        <td>${index+1}</td>
                        <td>${item['name']}</td>
                        <td>${item['email']}</td>
                        <td>${item['mobile']}</td>
                        <td>
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success" >Edit</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`
            tableList.append(row);        

        })

        $(".editBtn").on('click',async function()
    {
        let id=$(this).data('id');
        let res1=await axios.get("/customerBy",{params:{id:id}});
        if(res1.status===200 && res1.data['status']==="success")
    {
            let data=res1.data['data'];
            let name=data['name'];
            let email=data['email'];
            let mobile=data['mobile'];

            $("#update-modal").modal("show");
            $("#updateID").val(id);
            $("#customerNameUpdate").val(name);
            $("#customerEmailUpdate").val(email);
            $("#customerMobileUpdate").val(mobile);
    }
    else
    {
        errorToast("Customer not present");
    }
        
    })

        $(".deleteBtn").on('click',function()
    {
        let id=$(this).data('id');
        $("#delete-modal").modal("show");
        $("#deleteID").val(id);
    })

        let table = new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [5, 10, 15, 20]
        });

        
            
        
    }
</script>