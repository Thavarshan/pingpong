import moment from 'moment';

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export function diffForHumans(timestamp) {
    return moment(timestamp).fromNow();
}

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export function until(timestamp) {
    let birthday = moment(timestamp);
    let today = moment().format("YYYY-MM-DD");
    let age = moment(today).diff(birthday, 'years');
    moment(age).format("YYYY-MM-DD");
    let nextBirthday = moment(birthday).add(age, 'years');
    moment(nextBirthday).format("YYYY-MM-DD");
    nextBirthday = moment(birthday).add(age + 1, 'years');

    return `In ${nextBirthday.diff(today, 'days')} days`;
}

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export function simple(timestamp) {
    return moment(timestamp).format('ddd, MMM D');
}

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
 export function expanded(timestamp) {
    return moment(timestamp).format('dddd, MMMM Do YYYY');
}
