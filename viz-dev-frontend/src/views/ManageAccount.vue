<template>
  <div>
    <Navbar></Navbar>
    <h1 class="title">Jabar Viz Dev Account Management</h1>
    <div class="container__edit">
        <div class="header">
            <h3>Manage Users</h3>
            <button>Add new user</button>
        </div>
        <div class="container__table">
            <div class="flex-row">
                <div class="flex-col col-header">
                    <div class="row-header">User</div>
                    <div class="row-entry">User 1</div>
                    <div class="row-entry">User 2</div>
                    <div class="row-entry">User 3</div>
                    <div class="row-entry">User 4</div>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">Role</div>
                    <div class="row-entry">Role 1</div>
                    <div class="row-entry">Role 2</div>
                    <div class="row-entry">Role 3</div>
                    <div class="row-entry">Role 4</div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ManageAccount',
};
</script>

<style scoped>
.title {
    text-align: center;
}

.container__edit {
    padding: 15px 220px;
}

.container__table {
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.btn__add--user {
    border: 1px solid black;
    border-radius: 5px;
    background-color: green;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    float: right;
}

.flex-row {
    display: flex;
    flex-direction: row;
}

.flex-col {
    display: flex;
    flex-direction: column;
}

.row-header {
    font-weight: 600;
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, .1);
}

.col-header {
    flex: 1 1;
}

.row-entry {
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.row-entry:hover {
    background-color: rgba(0, 0, 0, .05);
}

.col-entry {
    flex: 0 0;
    flex-basis: 80px;
}
</style>
