export interface Question{
    radios: Alternative[];
}

export interface Alternative {
    question_id: number;
    comment: string;
    alternative: number;
}
