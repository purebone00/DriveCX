using System;
using System.Collections.Generic;
using Microsoft.EntityFrameworkCore.Migrations;

namespace DriveCX.Data.Migrations
{
    public partial class second : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "AvgCust",
                table: "Lead");

            migrationBuilder.RenameColumn(
                name: "Email",
                table: "Lead",
                newName: "email");

            migrationBuilder.RenameColumn(
                name: "CompanyName",
                table: "Lead",
                newName: "companyName");

            migrationBuilder.RenameColumn(
                name: "LastName",
                table: "Lead",
                newName: "l_name");

            migrationBuilder.RenameColumn(
                name: "FirstName",
                table: "Lead",
                newName: "f_name");

            migrationBuilder.RenameColumn(
                name: "AvgCheck",
                table: "Lead",
                newName: "avg_custNo");

            migrationBuilder.AddColumn<double>(
                name: "avg_check",
                table: "Lead",
                nullable: false,
                defaultValue: 0.0);

            migrationBuilder.AddColumn<bool>(
                name: "fullService",
                table: "Lead",
                nullable: false,
                defaultValue: false);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "avg_check",
                table: "Lead");

            migrationBuilder.DropColumn(
                name: "fullService",
                table: "Lead");

            migrationBuilder.RenameColumn(
                name: "email",
                table: "Lead",
                newName: "Email");

            migrationBuilder.RenameColumn(
                name: "companyName",
                table: "Lead",
                newName: "CompanyName");

            migrationBuilder.RenameColumn(
                name: "l_name",
                table: "Lead",
                newName: "LastName");

            migrationBuilder.RenameColumn(
                name: "f_name",
                table: "Lead",
                newName: "FirstName");

            migrationBuilder.RenameColumn(
                name: "avg_custNo",
                table: "Lead",
                newName: "AvgCheck");

            migrationBuilder.AddColumn<int>(
                name: "AvgCust",
                table: "Lead",
                nullable: false,
                defaultValue: 0);
        }
    }
}
