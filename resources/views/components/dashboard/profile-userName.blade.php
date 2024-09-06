<h6 id="userName"></h6>

<script>
    getUserName();
    async function getUserName()
    {
        let res=await axios.get("/user-profile");
        if(res.status===200 && res.data['status']==='success')
    {
            let data=res.data['data'];
            let firstName=data['firstName'];
            let lastName=data['lastName'];
            let fullName=firstName.concat(" ",lastName);

            document.getElementById("userName").textContent=fullName;
    }
    else
    {
        errorToast(res.data['message']);
    }
}
</script>