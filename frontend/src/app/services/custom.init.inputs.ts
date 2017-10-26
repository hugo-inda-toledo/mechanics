
export const CustomComboboxHoras= {
  values: [
     {id: 1 , name:'08:00 - 09:00',value:'08:00:00'},
     {id: 2 , name:'09:00 - 10:00',value:'09:00:00'},
     {id: 3 , name:'10:00 - 11:00',value:'10:00:00'},
     {id: 4 , name:'11:00 - 12:00',value:'11:00:00'},
     {id: 5 , name:'12:00 - 13:00',value:'12:00:00'},
     {id: 6 , name:'13:00 - 14:00',value:'13:00:00'},
     {id: 7 , name:'14:00 - 15:00',value:'14:00:00'},
     {id: 8 , name:'15:00 - 16:00',value:'15:00:00'},
     {id: 9 , name:'16:00 - 17:00',value:'16:00:00'},
     {id: 10, name:'17:00 - 18:00',value:'17:00:00'},
     {id: 11, name:'18:00 - 19:00',value:'18:00:00'},
     {id: 12, name:'19:00 - 20:00',value:'19:00:00'},
     {id: 13, name:'20:00 - 21:00',value:'20:00:00'},
     {id: 14, name:'21:00 - 22:00',value:'21:00:00'},
     {id: 15, name:'22:00 - 23:00',value:'22:00:00'},
     {id: 16, name:'23:00 - 00:00',value:'23:00:00'},
     {id: 17, name:'00:00 - 01:00',value:'00:00:00'},
     {id: 18, name:'01:00 - 02:00',value:'01:00:00'},
     {id: 19, name:'02:00 - 03:00',value:'02:00:00'},
     {id: 20, name:'03:00 - 04:00',value:'03:00:00'},
     {id: 21, name:'04:00 - 05:00',value:'04:00:00'},
     {id: 22, name:'05:00 - 06:00',value:'05:00:00'},
     {id: 23, name:'06:00 - 07:00',value:'06:00:00'},
     {id: 24, name:'07:00 - 08:00',value:'07:00:00'},
  ],
  getHoraId(id:number){
    for (let it of this.values) {
      if(it.id==id){
        return it.value;
      }
    }
    return '00:00:00';
  }
};
