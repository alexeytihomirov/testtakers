<template>
    <div class="container">
        <div class="controls">
            <button @click="loadFromCsv">Fill table from csv</button>
            <button @click="loadFromJson">Fill table from json</button>

            <button @click="loadFromJsonAsXml">Load json->xml</button>
            <button @click="loadFromCsvAsJson">Load csv->json</button>
            <button @click="loadFromCsvAsXml">Load csv->xml</button>
            <div>
                <h4>Response:</h4> <textarea>{{ rawResponse }}</textarea></div>
        </div>
        <table>
            <thead>
                <th v-for="header in getHeaders()">{{ header }}</th>
            </thead>
            <tr v-for="item in testtakers">
                <td v-for="head in getHeaders()">{{ item[head] }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                testtakers: [],
                rawResponse: ''
            }
        },
        methods: {
            loadFromCsv() {
                axios
                    .get('/api/source/testtakers.csv/testtakers.json')
                    .then(response => (this.testtakers = response.data, this.rawResponse = response.data));
            },
            loadFromJson() {
                axios
                    .get('/api/source/testtakers.json/testtakers.json')
                    .then(response => (this.testtakers = response.data, this.rawResponse = response.data));
            },
            loadFromJsonAsXml() {
                axios
                    .get('/api/source/testtakers.json/testtakers.xml')
                    .then(response => (this.rawResponse = response.data));
            },
            loadFromCsvAsXml() {
                axios
                    .get('/api/source/testtakers.csv/testtakers.xml')
                    .then(response => (this.rawResponse = response.data));
            },
            loadFromCsvAsJson() {
                axios
                    .get('/api/source/testtakers.csv/testtakers.json')
                    .then(response => (this.rawResponse = response.data));
            },
            getHeaders() {
                if (this.testtakers[0] !== undefined) {
                    return Object.keys(this.testtakers[0])
                } else {
                    return [];
                }
            }
        }
    }
</script>

<style>
    .controls {
        text-align: center;
        padding-top:20px;
    }
    table {
        margin: 20px auto;
    }
    td {
        padding: 5px;
        border-right: 1px solid #777;
    }
    textarea {
        margin: 5px;
        height: 200px;
        width: 50%;
    }
</style>