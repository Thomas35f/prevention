<template>
    <div v-if="companies" class="table-container">
        <div class="header">Mes Clients</div>
        <table class="styled-table">
            <thead>
            <tr>
                <th class="col-name">Nom</th>
                <th class="col-town">Ville</th>
                <th class="col-address">Adresse</th>
                <th class="col-contact">Contact</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(company, index) in filledCompanies"
                :key="index"
                :class="{ 'selected': company.selected }"
                @click="selectCompany(index)"
            >
                <td class="col-name">{{ company.name }}</td>
                <td class="col-town">{{ company.town }}</td>
                <td class="col-address">{{ company.address }}</td>
                <td class="col-contact">{{ company.contact }}</td>
            </tr>
            </tbody>
        </table>
        <div class="footer">
            <button class="footer-button button-add">Ajouter</button>
            <button class="footer-button button-edit">Modifier</button>
            <button class="footer-button button-delete">Supprimer</button>
        </div>
    </div>
</template>


<script lang="ts" setup>
import { onMounted, computed, ref } from 'vue';
import useCompanies from '../composables/companies';

const { companies, getCompanies } = useCompanies();

onMounted(getCompanies);

const filledCompanies = computed(() => {
    const fillLength = 6 - companies.value.length;
    return fillLength > 0 ? companies.value.concat(Array(fillLength).fill({})) : companies.value;
});

const selectCompany = (index: string | number) => {
    filledCompanies.value[index].selected = !filledCompanies.value[index].selected;
}
</script>


<style scoped>
.header {
    position: sticky;
    top: 0;
    background-color: #1C3356;
    text-align: center;
    color: white;
    padding: 8px;
    border: 1px solid #000;
    z-index: 1;
    font-size: 20px;
}

.table-container {
    margin-right: 60px;
    margin-top: 30px;
    max-height: 336px;
    overflow-y: auto;
    -ms-overflow-style: none;
    scrollbar-width: none;
    border-radius: 10px;
}

.table-container::-webkit-scrollbar {
    display: none;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #1C3356;
    color: white;
}

.styled-table th,
.styled-table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
    height: 3em;
}

.styled-table tbody tr{
    height: 3em;
}

.styled-table thead {
    border-bottom: 2px solid #000;
    background-color: #1C3356;
}

.styled-table thead tr th {
    position: sticky;
    top: 0;
    background-color: #1C3356;
}

.col-name {
    width: 25%;
}

.col-town {
    width: 25%;
}
.col-address {
    width: 25%;
}

.col-contact {
    width: 25%;
}

.footer {
    position: sticky;
    bottom: 0;
    background-color: rgba(28, 51, 86, 0.8);
    border-radius: 10px;
    padding: 8px;
    border: 1px solid #000;
    color: white;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    height: 3em;
    display: flex;
    justify-content: center;
}

.footer-button {
    color: white;
    border: none;
    padding: 5px;
    text-align: center;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 10px;
    flex: 1;
    min-width: 100px;
    margin: 0 10px;
    outline: none !important;
    box-shadow: none !important;
    max-width: 115px;
}

.button-add {
    background-color: #36BB4E;
}

.button-add:hover {
    background-color: #2da03c;
}

.button-edit {
    background-color: #BB5E36;
}

.button-edit:hover {
    background-color: #a54f2d;
}

.button-delete {
    background-color: #BB3636;
}

.button-delete:hover {
    background-color: #a02e2e;
}

@media (max-width: 975px) {
    .table-container {
        margin-left: 20px;
        margin-right: 20px;
        width: 424px;
    }
}

</style>



