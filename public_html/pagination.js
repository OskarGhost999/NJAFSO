// function to navigate betweens form steps
const navigateToFormStep = (stepNumber) => {

    // hide all form steps
   document.querySelectorAll(".form-step").forEach((formStepElement) => {
       formStepElement.classList.add("d-none");
   });

    // mark all form steps as unfinished
   document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
       formStepHeader.classList.add("form-stepper-unfinished");
       formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
   });

    // show the current form step (as passed to function)
   document.querySelector("#step-" + stepNumber).classList.remove("d-none");

    // select the form step circle (progress bar)
   const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');

    // mark the current form step as active
   formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
   formStepCircle.classList.add("form-stepper-active");
   /**
    * loop through each form step circle up to the current step number
    * ex: if current step is 3 the loop will perform operations for step 1 and 2
    */
   for (let index = 0; index < stepNumber; index++) {

       // select the form step circle (progress bar)
       const formStepCircle = document.querySelector('li[step="' + index + '"]');

        // check if the element exists and proceed if yes
       if (formStepCircle) {

           //mark the form step as completed
           formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
           formStepCircle.classList.add("form-stepper-completed");
       }
   }
};

// select all form navigation buttons and loop through 
document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {

   // add a click event listener to button
   formNavigationBtn.addEventListener("click", () => {

        // get value of step
       const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
       
       //call  function to navigate to the target form step
       navigateToFormStep(stepNumber);
   });
});