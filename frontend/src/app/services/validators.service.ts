import { FormGroup, FormControl, ValidatorFn, AbstractControl} from '@angular/forms';


export function emailValidator(control: FormControl): {[key: string]: any} {
    var emailRegexp = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    if (control.value && !emailRegexp.test(control.value)) {
        return {invalidEmail: true};
    }
}

export function matchingPasswords(passwordKey: string, passwordConfirmationKey: string) {
    return (group: FormGroup) => {
        let password= group.controls[passwordKey];
        let passwordConfirmation= group.controls[passwordConfirmationKey];
        if (password.value !== passwordConfirmation.value) {
            return passwordConfirmation.setErrors({mismatchedPasswords: true})
        }
    }
}


/*export function checkIfAlreadyAdded(array: Array<any>): ValidatorFn{
  return (control: AbstractControl): {[key: string]: any} => {
    let response: boolean = false;
    for(let elem of array){
      if(elem.id === control.value)
        response= true;
    }
    if(response)
      return {isAlreadyAdded: true};
    else
      return null;
  };
}*/
