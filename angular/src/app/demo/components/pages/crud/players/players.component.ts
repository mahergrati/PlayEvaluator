import { Component, OnInit } from '@angular/core';
import { ButtonModule } from "primeng/button";
import { FileUploadModule } from "primeng/fileupload";
import { RippleModule } from "primeng/ripple";
import {ConfirmationService, MessageService, SharedModule} from "primeng/api";
import { ToastModule } from "primeng/toast";
import { ToolbarModule } from "primeng/toolbar";
import { PlayerService } from "../../../../service/player.service";
import { Router } from "@angular/router";
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import {TableModule} from "primeng/table";
import {DialogModule} from "primeng/dialog";

@Component({
    selector: 'app-players',
    standalone: true,
    imports: [
        ButtonModule,
        FileUploadModule,
        RippleModule,
        SharedModule,
        ToastModule,
        ToolbarModule,
        CommonModule,
        FormsModule,
        TableModule,
        DialogModule
    ],
    templateUrl: './players.component.html',
    styleUrls: ['./players.component.scss']
})
export class PlayersComponent implements OnInit {
    name!: string;
    cin!: string;
    role!: string;
    team!: string;
    score!: number;
    loadingtitle: string = 'Loading';
    errors: any = [];
    isloading: boolean = false;
    questions: any[] = [
        { text: 'Make a goal', options: [{ value: 'a', text: 'Yes' }, { value: 'b', text: 'No' }] },
        { text: 'Make an assist', options: [{ value: 'a', text: 'Yes' }, { value: 'b', text: 'No' }] },
        { text: 'Key Passes and Crosses:', options: [{ value: 'a', text: 'More than 80%' }, { value: 'b', text: 'Less than 80%' }] },
        { text: 'Defensive Contributions:', options: [{ value: 'a', text: 'Win most of duels' }, { value: 'b', text: 'Not' }] },
        { text: 'Make correct interceptions', options: [{ value: 'a', text: 'More than 80%' }, { value: 'b', text: 'Less than 80%' }] },
        { text: 'Make a penalty', options: [{ value: 'a', text: 'Yes' }, { value: 'b', text: 'No' }] },
        { text: 'Leadership and Influence:', options: [{ value: 'a', text: 'Demonstrating leadership qualities' }, { value: 'b', text: 'Not' }] },
        { text: 'Moment of Brilliance:', options: [{ value: 'a', text: 'Executing a game-changing moment' }, { value: 'b', text: 'Not' }] },
        { text: 'Set Piece Mastery', options: [{ value: 'a', text: 'Excellence in taking set pieces' }, { value: 'b', text: 'Not' }] }
    ];
    answers: string[] = new Array(this.questions.length).fill('');
    players: any[];
    selectedPlayer: any = {};
    displayAddPlayerDialog: boolean = false;

    constructor(private playerService: PlayerService, private router: Router) { }

    ngOnInit(): void {
        this.getPlayer();
    }

    calculateScore(): number {
        let score = 0;
        for (let i = 0; i < this.answers.length; i++) {
            if (this.answers[i] === 'a') {
                score++;
            }
        }
        return score;
    }

    deletePlayer(id: number): void {
        if (confirm('Are you sure you want to delete this player?')) {
            this.playerService.deletePlayer(id).subscribe(() => {
                this.getPlayer();
            });
        }
    }

    submitQuiz() {
        this.score = this.calculateScore();
        console.log('Calculated score:', this.score); // Add this line
        if (this.selectedPlayer.id) {
            this.updatePlayer(this.selectedPlayer.id)
        } else {
            this.savePlayer();
        }
    }

    savePlayer() {
        this.isloading = true;
        this.loadingtitle = 'Saving';
        const inputData = {
            name: this.name,
            cin: this.cin,
            role: this.role,
            team: this.team,
            score: this.score
        };
        console.log('Saving player with data:', inputData); // Add this line
        this.playerService.savePlayer(inputData).subscribe({
            next: (res: any) => {
                console.log('Player saved successfully:', res); // Add this line
                alert(res.message);
                this.players.push(res.player); // Ajouter le nouveau joueur à la liste des joueurs
                this.resetForm();
                this.isloading = false;
                this.displayAddPlayerDialog = false; // Fermer le dialogue après l'ajout
            },
            error: (err: any) => {
                this.errors = err.error.errors;
                this.isloading = false;
                console.log('Error saving player:', err); // Add this line
            }
        });
    }

    updatePlayer(id: number) {
        this.isloading = true;
        this.loadingtitle = 'Updating';
        const inputData = {
            name: this.name,
            cin: this.cin,
            role: this.role,
            team: this.team,
            score: this.score
        };
        console.log('Updating player with data:', inputData);
        this.playerService.updatePlayer(id, inputData).subscribe({
            next: (res: any) => {
                console.log('Player updated successfully:', res);
                alert(res.message);
                const index = this.players.findIndex(player => player.id === id);
                if (index !== -1) {
                    this.players[index] = res.player;
                }
                this.resetForm();
                this.isloading = false;
                this.displayAddPlayerDialog = false;
            },
            error: (err: any) => {
                this.errors = err.error.errors;
                console.log('Error updating player:', err);
                this.isloading = false;
            }
        });
    }


    getPlayer(): void {
        this.playerService.getPlayers().subscribe({
            next: (res: any) => {
                console.log('Players list:', res);
                this.players = res.players;
                // Handle the list of players here
            },
            error: (err: any) => {
                console.log('Error fetching players list:', err);
            }
        });
    }

    resetForm() {
        this.name = '';
        this.cin = '';
        this.role = '';
        this.team = '';
        this.score = 0;
        this.answers = new Array(this.questions.length).fill('');
    }

    openNew() {
        this.selectedPlayer = {};
        this.answers = [];
        this.displayAddPlayerDialog = true;
    }

    editPlayer(player: any) {
        this.selectedPlayer = { ...player };
        this.name = player.name;
        this.cin = player.cin;
        this.role = player.role;
        this.team = player.team;
        this.score = player.score;
        this.answers = new Array(this.questions.length).fill('');
        this.displayAddPlayerDialog = true;
    }
}
