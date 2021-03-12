<template>
  <div>
    <!-- <form method="post" action="{{url('exams/modify-exam-store')}}"> -->
    <form v-on:submit.prevent="submitForm">
      <div class="list-group col" id="examinationQuestions">
        <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestion(examination.id)">Soru Ekle</button>
        <br>
        <draggable ghost-class="ghost" @end="onEnd">
          <transition-group>
              <div v-for="examinationquestion in examinationquestions" :key="examinationquestion.id">
                <div v-if="examination.id == examinationquestion.examination_id">
                  <div class="list-group-item">
                    <textarea name="content" rows="2" cols="80" required>{{examinationquestion.content}}</textarea>
                    <button type="button" class="btn btn-primary btn-outline-light" style="background:#B60C09" @click="deleteQuestion(examinationquestion.id)">Soruyu Sil</button>
                    <br>
                    <div v-for="(value, key) in examinationquestion.options">
                      <input type="text" v-model="key" style="width:30px;"> :
                      <input type="text" v-model="examinationquestion.options[key]">
                      <button type="button" class="btn btn-primary btn-outline-light btn-sm" style="background:#B60C09" @click="deleteQuestionOption(examinationquestion.id,key)">X</button>
                      <br><br>
                    </div>
                    <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestionOption(examinationquestion.id)">Şık Ekle</button>
                  </div>
                </div>
              </div>
          </transition-group>
        </draggable>
      </div>
      <br>
      <div align="center">
        <button class="btn btn-primary btn-outline-light" style="background:#19A713;">Kaydet</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import draggable from 'vuedraggable';

    export default {
        props: [
          'examinationquestions',
          'examination'
        ],
        components: {
          draggable,
        },
        data() {
          return {
            myArray:[
              {name: "11111", id: "aaaaaaaaaaaaa"},
            ],
            oldIndex: "",
            newIndex: "",
          }
        },
        methods:{
          addNewQuestion(id){
            axios.post('/exams/modify-exam-add-question', {
              examinationId: id,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error addNewQuestion failed!');
                 });
          },
          deleteQuestion(id){
            let examinationQuestionId = id;
            console.log(examinationQuestionId);
            axios.delete('/exams/modify-exam/'+examinationQuestionId)
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error deleteQuestion failed!');
                 });
          },
          addNewQuestionOption(id){
            axios.post('/exams/modify-exam-add-question-option', {
              examinationQuestionId: id,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error addNewQuestionOption failed!');
                 });
          },
          deleteQuestionOption(id,key){
            axios.post('/exams/modify-exam-delete-question-option', {
              examinationQuestionId: id,
              jsonKey: key,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error deleteQuestion failed!');
                 });
          },
          onEnd: function(evt) {
            console.log(evt);
            this.oldIndex = evt.oldIndex;
            this.newIndex = evt.newIndex;
          }
        },
        mounted() {
            console.log('Examination Form Component Mounted.');
        }
    }
</script>
