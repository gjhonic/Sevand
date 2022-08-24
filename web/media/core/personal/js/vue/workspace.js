let app = new Vue({
    el: '#app',
    data: {
        config: {
            projectName: 'Tasks',
            version: '0.1',
            lang: 'en',
            author: 'gjhonic',
        },
        //Модалки
        showModalItemTask: false,
        showModalItemBranch: false,
        //Ссылки
        url_get_tasks: '../backend/actions/get-tasks.php',
        url_get_branches: '../backend/actions/get-branches.php',
        url_create_task: '../backend/actions/create-task.php',
        url_create_branch: '../backend/actions/create-branch.php',
        url_update_task: '../backend/actions/update-task.php',
        url_delete_task: '../backend/actions/delete-task.php',
        url_delete_branch: '../backend/actions/delete-branch.php',
        //Данные
        tasksData: [],
        branchesData: [],
        property: '',
    },
    computed: {
        Tasks() {
            return this.tasksData;
        },
        Branches() {
            return this.branchesData;
        },
    },
    methods: {
        loadTasks(callback) {
            startLoad();
            fetch(this.url_get_tasks, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    this.tasksData = data.dataTasks;
                    endLoad();
                } else {
                    endLoad();
                    panelDanger(true, 'Error loading tasks')
                }


                if (typeof callback !== 'undefined') {
                    let timerId = setTimeout(function () {
                        callback();
                    }, 500);
                }
            });
        },
        loadBranches(callback) {
            startLoad();
            fetch(this.url_get_branches, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    this.branchesData = data.dataBranches;
                    endLoad();
                } else {
                    endLoad();
                    panelDanger(true, 'Error loading branches')
                }

                if (typeof callback !== 'undefined') {
                    let timerId = setTimeout(function () {
                        callback();
                    }, 500);
                }
            });
        },
        //Удаление записи с предупреждением
        stopperDelete(url, id) {
            let answer = confirm("Are you sure you want to delete this item?");
            console.log(url + '?id=' + id);
            if(answer == true) {
                let body = {
                    id: id
                };
                fetch(url, {
                    method: "POST",
                    body: JSON.stringify(body),
                }).then((response) => response.json())
                    .then((data) => {
                        if(data.status == 'success') {
                            this.loadBranches();
                            this.loadTasks();
                        } else {
                            alert(data.message)
                        }
                    });
            }
        },

        //Возвращает имя ветки
        getBranchName(idBranch) {
            for(branch in this.Branches) {
                if(this.Branches[branch].id == idBranch) {
                    return this.Branches[branch].name;
                }
            }
        },

        //Возвращает название статуса
        getStatusName(idStatus) {
            switch(idStatus) {
                case '1':
                  return 'New';
                case '2':
                  return 'Active';
                case '3':
                    return 'Test';
                case '4':
                    return 'Pause';
                default:
                  return 'Not found'
              }
        }
    },
    mounted() {
        this.loadTasks();
        this.loadBranches();
    },
});
