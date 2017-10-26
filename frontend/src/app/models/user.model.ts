export class User {
  id: string;
  role_id: number;
  name: string;
  last_name: number;
  email : string;
  phone1: string;
  //phone2?: number;
  //address_name?: string;
  //address_number?: string;
  //address_complement?: string;
  commune_id: number;
  city_id : number;
  password: string;
  photo_url: string;
  //sex?: string;
}

export const UserRoles = {
     '5':{
       'role': 'client',
       'name': 'Cliente',
       'id': '5'
     },
     '6':{
       'role': 'mechanic',
       'name': 'Mecánico',
       'id': '6'
     }
};
