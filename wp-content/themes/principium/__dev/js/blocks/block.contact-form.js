import JustValidate from "just-validate";
import JustValidatePluginDate from "just-validate-plugin-date";
import {justValidateDict, today} from "../config/just-validate";

export function blockContactForm() {
    document.querySelectorAll('.contact-form-block form').forEach((form) => {
        const validation = new JustValidate(form, undefined, justValidateDict);

        validation.setCurrentLocale(currentLanguage)

        form.querySelectorAll('input:not([type="hidden"])').forEach((input) => {
            const rules = []

            if (input.hasAttribute('required')) {
                rules.push({rule: 'required'})
            }

            const input_type = input.getAttribute('type');
            switch (input_type) {
                case 'email':
                    rules.push({rule: 'email'})
                    break;
                case 'tel':
                    rules.push({rule: 'number'})
                    break;
                case 'date':
                    rules.push({
                        plugin: JustValidatePluginDate(() => ({
                            required: true,
                            format: 'yyyy-MM-dd',
                            isAfter: today,
                        })),
                        errorMessage: "must be after",
                    })
                    break
            }

            if (rules.length > 0) {
                validation.addField(input, rules)
            }
        })

        validation.onSuccess((e) => {
            e.preventDefault();

            let formData = new FormData(form)
            formData.append("action", "send_contact_form");

            fetch(site_objects.ajax_url, {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((res) => {
                    form.querySelector(".response").innerHTML = res.data;
                    if (res.success) {
                        form.reset();
                    }
                })

        })
    })
}

const currentLanguage = document.querySelector('html').getAttribute('lang')