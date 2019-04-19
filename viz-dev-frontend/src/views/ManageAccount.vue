<template>
  <div>
    <Navbar />
    <div class="container" >
        <h1 class="title">Manajemen Akun</h1>
        <button class="btn add-user">Tambah akun</button>
        <ModalEditRole
            v-bind="modalEditRoleProps"
            v-if="showModalUserEdit"
            @modalClosed="toggleModalUserEdit" />
        <div class="table">
            <div class="table-row table-header">
                <div class="table-cell flex-1">User</div>
                <div class="table-cell center role">Role</div>
                <div class="table-cell center action">Aksi</div>
            </div>
            <div class="table-row" v-for="user in users" v-bind:key="user.username">
                <div class="table-cell flex-1">{{user.username}}</div>
                <div class="table-cell center role">{{user.role}}</div>
                <div class="table-cell center action">
                    <button class="btn " @click="toggleModalUserEdit">Ubah</button>
                    <button class="btn danger" @click="toggleModalUserEdit">Hapus</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import ModalEditRole from '@/components/ModalUserEdit.vue';

const mockUsers = [
  {
    username: 'Jaenudin', email: 'jaenudin@gmail.com', insitusi: 'pemprov', role: 'Admin',
  },
  {
    username: 'Adel', email: 'adel@gmail.com', insitusi: 'bapeda', role: 'editor',
  },
  {
    username: 'Brokoli', email: 'brokoli@gmail.com', insitusi: 'bpjs', role: 'editor',
  },
  {
    username: 'Meganus', email: 'meganus@gmail.com', insitusi: 'perda', role: 'editor',
  },
  {
    username: 'Charlotte', email: 'charlotte@gmail.com', insitusi: 'bpk', role: 'editor',
  },
  {
    username: 'Kokoro', email: 'kokoro@gmail.com', insitusi: 'kpk', role: 'editor',
  },
  {
    username: 'No Tomo', email: 'no-tomo@gmail.com', insitusi: 'lpm', role: 'editor',
  },
  {
    username: 'Brigadir', email: 'brigadir@gmail.com', insitusi: 'BI', role: 'editor',
  },
];

export default {
  username: 'ManageAccount',
  components: {
    ModalEditRole,
  },
  methods: {
    toggleModalUserEdit() {
      this.showModalUserEdit = !this.showModalUserEdit;
    },
  },
  data() {
    return {
      users: mockUsers,
      showModalUser: false,
      showModalUserEdit: false,
      modalEditRoleProps: {
        user: mockUsers[0],
      },
    };
  },
};
</script>

<style scoped lang="scss">
@import '../styles/components/table';

.title {
    text-align: center;
    margin: 1.5em 0;
}

.btn.add-user {
    margin-left: 0;
}

.table-cell.role { width: 100px; }
.table-cell.action {
    width: 170px;

    .btn {
        padding: 5px 10px;
    }

    .btn.danger {
        background-color: rgba(250, 100, 100, 1);
    }

    .btn.danger:hover {
        background-color: rgba(250, 40, 40, 1);
    }
}

</style>
