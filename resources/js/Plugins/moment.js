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
