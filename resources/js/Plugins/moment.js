import moment from 'moment';

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export function diffForHumans(timestamp, suffix = false) {
    return moment(timestamp).fromNow(suffix);
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

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export function birthday(timestamp) {
    return moment(timestamp).format('MMMM Do YYYY');
}
