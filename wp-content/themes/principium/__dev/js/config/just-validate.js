export const today = new Date().toLocaleDateString('en-CA');
export const justValidateDict = [
    {
        key: 'required',
        dict: {
            'en-US' : 'The field is required',
            'da-DK' : 'Feltet skal udfyldes'
        }
    },
    {
        key: 'email',
        dict: {
            'en-US' : 'Email has invalid format',
            'da-DK' : 'E-mailen har ugyldigt format'
        }
    },
    {
        key: 'number',
        dict: {
            'en-US' : 'Value should be a number',
            'da-DK' : 'Værdien skal være et nummer'
        }
    },
    {
        key: 'must be after',
        dict: {
            'en-US' : 'Date must be after : ' + today,
            'da-DK' : 'Datoen skal være efter : ' + today
        }
    }
]