<template>
  <div>
    <Navbar></Navbar>
    <h1 class="title">Jabar Viz Dev Account Management</h1>
    <div class="container__edit">
        <div class="header">
            <h3>Manage Users</h3>
        </div>
        <div class="container__table">
            <div class="flex-row">
                <div class="flex-col col-header">
                    <div class="row-header">User</div>
                    <div class="row-entry user">User 1</div>
                    <div class="row-entry user">User 2</div>
                    <div class="row-entry user">User 3</div>
                    <div class="row-entry user">User 4</div>
                    <div class="row-entry user">User 5</div>
                    <div class="row-entry user">User 6</div>
                    <div class="row-entry user">User 7</div>
                    <div class="row-entry user">User 8</div>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">Role</div>
                    <div class="row-entry role">Role 1 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 2 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 3 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 4 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 5 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 6 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 7 <button class="btn__edit--role">Edit</button></div>
                    <div class="row-entry role">Role 8 <button class="btn__edit--role">Edit</button></div>
                </div>
            </div>
        </div>
        <button class="btn__add--user">Add new user</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ManageAccount',
  data() {
      return {

      }
  },
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
    float: right;
    border: 0;
    background-color: rgba(6, 116, 210, 1);
    border-radius: 5px;
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 0;
    color: white;
}

.btn__add--user:hover {
    background-color: rgb(10, 84, 150);
    transform: scale(1.1);
}

.btn__edit--role {
    float: right;
    border: 0; 
    background-color: skyblue;
    border-radius: 5px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    padding: 5px 20px;
}

.btn__edit--role:hover {
    background-color: rgba(6, 116, 210, 1);
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
}

.user {
    cursor: pointer;
}

.user:hover {
    background-color: rgba(0, 0, 0, .05);
    font-weight: 600;
}

.role {
    display: inline-block;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.col-entry {
    flex: 0 0;
    flex-basis: 150px;
}

</style>
